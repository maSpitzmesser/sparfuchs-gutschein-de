/**
 * Sparfuchs-Gutschein – Verhalten im Frontend, ohne jQuery.
 * Konfiguration aus PHP: window.sgConfig (siehe inc/assets.php).
 */
(() => {
  'use strict';

  const config = window.sgConfig || {};
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => [...root.querySelectorAll(selector)];
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Cookies ---------- */

  const cookie = {
    get(name) {
      const match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=([^;]*)'));
      return match ? decodeURIComponent(match[1]) : null;
    },
    set(name, value, days) {
      const expires = new Date(Date.now() + days * 864e5).toUTCString();
      document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/; SameSite=Lax`;
    },
  };

  /* ---------- Design-Wechsler ---------- */

  function initDesignSwitcher() {
    const stylesheet = $('#active-theme');
    if (!stylesheet) return;
    const designs = config.designs || [];
    const base = stylesheet.getAttribute('href').replace(/[^/]+\/theme\.css(\?.*)?$/, '');
    const version = stylesheet.dataset.version;

    const markActive = (design) => {
      $$('[data-design]').forEach((button) => {
        const active = button.dataset.design === design;
        button.classList.toggle('is-active', active);
        button.textContent = active ? 'Aktives Design' : 'Design ändern';
        button.setAttribute('aria-pressed', String(active));
      });
    };

    markActive(stylesheet.dataset.activeDesign);

    document.addEventListener('click', (event) => {
      const button = event.target.closest('[data-design]');
      if (!button || !designs.includes(button.dataset.design)) return;
      const design = button.dataset.design;
      stylesheet.href = `${base}${design}/theme.css${version ? `?ver=${version}` : ''}`;
      stylesheet.dataset.activeDesign = design;
      cookie.set(config.designCookie || 'selected_theme', design, 365);
      markActive(design);
      // Im Dialog geöffnet: Seite dahinter gleich mit umstellen
      const parentSheet = window.parent !== window ? window.parent.document.querySelector('#active-theme') : null;
      if (parentSheet) parentSheet.href = stylesheet.href;
    });
  }

  /* ---------- Cookie-Hinweis ---------- */

  function initCookieBanner() {
    const banner = $('.cookie-banner');
    if (!banner) return;
    if (cookie.get('cookie_banner')) {
      banner.remove();
      return;
    }
    banner.classList.remove('hidden');
    $('.cookie-banner-close', banner)?.addEventListener('click', () => {
      cookie.set('cookie_banner', '1', 365);
      banner.remove();
    });
  }

  /* ---------- Hauptmenü (mobil) und mitlaufende Leiste ---------- */

  function initMenu() {
    const nav = $('.main-menu');
    const button = $('.mobile-menu-button', nav || document);
    const list = nav && $('ul', nav);
    if (!nav || !button || !list) return;

    button.addEventListener('click', () => {
      const open = !nav.classList.contains('open');
      button.setAttribute('aria-expanded', String(open));
      if (open) {
        list.classList.add('hamburger-menu');
        nav.classList.add('open');
      } else {
        nav.classList.remove('open');
        setTimeout(() => list.classList.remove('hamburger-menu'), 300);
      }
    });

    // Menü bleibt oben stehen, sobald es aus dem Bild scrollt
    const marker = document.createElement('div');
    marker.setAttribute('aria-hidden', 'true');
    nav.before(marker);
    new IntersectionObserver(([entry]) => {
      nav.classList.toggle('sticky', !entry.isIntersecting && entry.boundingClientRect.top < 0);
    }).observe(marker);
  }

  /* ---------- Reiter und Ansichtswechsel ---------- */

  function initTabs() {
    const tabs = $$('.tabs li');
    const panels = $$('.sk');
    if (!tabs.length) return;

    const select = (index, focus = false) => {
      tabs.forEach((tab, i) => {
        const active = i === index;
        tab.classList.toggle('active', active);
        tab.setAttribute('aria-selected', String(active));
        tab.tabIndex = active ? 0 : -1;
        panels[i]?.classList.toggle('hidden', !active);
      });
      if (focus) tabs[index].focus();
    };

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => select(index));
      tab.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowRight') select((index + 1) % tabs.length, true);
        if (event.key === 'ArrowLeft') select((index - 1 + tabs.length) % tabs.length, true);
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          select(index);
        }
      });
    });
  }

  function initViewSwitch() {
    $$('select[data-view-switch]').forEach((select) => {
      const views = $$(select.dataset.viewSwitch);
      select.addEventListener('change', () => {
        views.forEach((view, i) => view.classList.toggle('hidden', String(i) !== select.value));
      });
    });
  }

  /* ---------- Klickbare Zeilen und Gutscheine ---------- */

  function goUrl(route, id) {
    return `${config.goUrl || '/go/'}${route}?id=${encodeURIComponent(id)}`;
  }

  function initClickableRows() {
    document.addEventListener('click', (event) => {
      if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey) return;

      // Kurzlisten: ganze Zeile führt zum Shop
      const row = event.target.closest('ul.cs li, ul.g li');
      if (row && !event.target.closest('a')) {
        const link = $('a', row);
        if (link) window.location.href = link.href;
        return;
      }

      // Gutschein-Karte: neuer Tab zeigt den Code, aktueller Tab geht über /go/ zum Shop
      const offer = event.target.closest('ul.c li[data-offer-id]');
      if (!offer || event.target.closest('a')) return;
      const id = offer.dataset.offerId;
      const publisher = offer.dataset.publisher || 'aw';
      const pageWithCode = `${location.origin}${location.pathname}#${publisher}!${id}`;
      window.open(pageWithCode, '_blank', 'noopener');
      setTimeout(() => window.location.assign(goUrl(publisher, id)), 200);
    });
  }

  /* ---------- Dialog (statt Fancybox) ---------- */

  function initDialog() {
    const dialog = $('.sg-dialog');
    if (!dialog || typeof dialog.showModal !== 'function') return;
    const frame = $('.sg-dialog-frame', dialog);

    const open = (url, narrow = false) => {
      dialog.classList.toggle('is-narrow', narrow);
      frame.src = url;
      dialog.showModal();
    };
    const close = () => dialog.close();

    dialog.addEventListener('close', () => {
      frame.src = 'about:blank';
      if (/^#[a-z]+!\d+$/.test(location.hash)) history.replaceState(null, '', location.pathname + location.search);
    });
    $('.sg-dialog-close', dialog).addEventListener('click', close);
    dialog.addEventListener('click', (event) => {
      if (event.target === dialog) close();
    });

    // Links zur Anleitung oder zum Kontakt öffnen im Dialog
    document.addEventListener('click', (event) => {
      const link = event.target.closest('a.lightbox-open, a.lightbox-open-450');
      if (!link || event.metaKey || event.ctrlKey) return;
      event.preventDefault();
      const url = new URL(link.href);
      url.searchParams.set('lightbox', 'true');
      open(url.toString(), link.classList.contains('lightbox-open-450'));
    });

    // Seite mit #aw!<ID> zeigt den Gutschein im Dialog (vom Gutschein-Klick im neuen Tab)
    const match = location.hash.match(/^#([a-z]+)!(\d+)$/);
    if (match) open(goUrl(`layer-${match[1]}`, match[2]), true);
  }

  /* ---------- Video erst nach Klick ---------- */

  function initLazyVideos() {
    $$('.lazy-video[data-youtube-id]').forEach((box) => {
      $('.lazy-video-play', box)?.addEventListener('click', () => {
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube-nocookie.com/embed/${encodeURIComponent(box.dataset.youtubeId)}?autoplay=1&rel=0`;
        iframe.title = 'YouTube-Video';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        box.replaceChildren(iframe);
        box.classList.remove('preview');
      });
    });
  }

  /* ---------- Nach oben, Abschnitts-Navigation ---------- */

  function initScrolling() {
    const toTop = document.createElement('a');
    toTop.className = 'scroll-to-top hidden';
    toTop.href = '#';
    toTop.textContent = 'nach oben ↑';
    document.body.append(toTop);

    let ticking = false;
    window.addEventListener('scroll', () => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => {
        toTop.classList.toggle('hidden', window.scrollY <= 700);
        ticking = false;
      });
    }, { passive: true });

    document.addEventListener('click', (event) => {
      if (!event.target.closest('a.scroll-to-top, a.top, a.oben')) return;
      event.preventDefault();
      window.scrollTo({ top: 0, behavior: reducedMotion ? 'auto' : 'smooth' });
    });

    const sideLinks = $$('.side-nav a[href^="#"]');
    const sections = sideLinks.map((link) => document.getElementById(link.hash.slice(1))).filter(Boolean);
    if (!sections.length) return;
    const observer = new IntersectionObserver((entries) => {
      entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
        sideLinks.forEach((link) => link.classList.toggle('current', link.hash === `#${entry.target.id}`));
      });
    }, { rootMargin: '-40% 0px -55% 0px' });
    sections.forEach((section) => observer.observe(section));
  }

  /* ---------- Shop-Suche mit Vorschlägen ---------- */

  function initSearch() {
    const input = $('#s');
    if (!input || !config.searchUrl) return;

    const box = document.createElement('div');
    box.id = 'ac_s';
    box.setAttribute('role', 'listbox');
    document.body.append(box);

    let controller = null;
    let timer = 0;
    let selected = -1;

    const position = () => {
      const rect = input.getBoundingClientRect();
      box.style.top = `${rect.bottom + window.scrollY + 8}px`;
      box.style.left = `${rect.left + window.scrollX}px`;
      box.style.width = `${Math.max(rect.width, 280)}px`;
    };
    const hide = () => {
      box.style.display = 'none';
      selected = -1;
    };
    const items = () => $$('a', box);
    const highlight = (index) => {
      const links = items();
      selected = (index + links.length) % links.length;
      links.forEach((link, i) => link.closest('li').classList.toggle('selected', i === selected));
    };

    const render = (shops) => {
      box.replaceChildren();
      if (!shops.length) {
        hide();
        return;
      }
      const list = document.createElement('ul');
      shops.forEach((shop) => {
        const li = document.createElement('li');
        li.setAttribute('role', 'option');
        const link = document.createElement('a');
        link.href = shop.url;
        const img = document.createElement('img');
        img.src = shop.logo;
        img.alt = '';
        const name = document.createElement('b');
        name.textContent = shop.title;
        link.append(img, name);
        li.append(link);
        list.append(li);
      });
      box.append(list);
      position();
      box.style.display = 'block';
      selected = -1;
    };

    input.addEventListener('input', () => {
      clearTimeout(timer);
      const term = input.value.trim();
      if (!term) {
        hide();
        return;
      }
      timer = setTimeout(async () => {
        controller?.abort();
        controller = new AbortController();
        try {
          const url = new URL(config.searchUrl, location.href);
          url.searchParams.set('search', term);
          const response = await fetch(url, { signal: controller.signal, headers: { Accept: 'application/json' } });
          render(response.ok ? await response.json() : []);
        } catch (error) {
          if (error.name !== 'AbortError') hide();
        }
      }, 150);
    });

    input.addEventListener('keydown', (event) => {
      if (box.style.display !== 'block') return;
      if (event.key === 'ArrowDown') {
        event.preventDefault();
        highlight(selected + 1);
      } else if (event.key === 'ArrowUp') {
        event.preventDefault();
        highlight(selected - 1);
      } else if (event.key === 'Enter' && selected >= 0) {
        event.preventDefault();
        window.location.href = items()[selected].href;
      } else if (event.key === 'Escape') {
        hide();
      }
    });

    document.addEventListener('click', (event) => {
      if (!box.contains(event.target) && event.target !== input) hide();
    });
    window.addEventListener('resize', () => box.style.display === 'block' && position());
  }

  /* ---------- Karussell (Slick-kompatible Klassen für die Designs) ---------- */

  function initCarousel(root) {
    const fade = root.dataset.carousel === 'fade';
    const slides = [...root.children];
    if (slides.length < 2) return;

    const list = document.createElement('div');
    list.className = 'slick-list';
    const track = document.createElement('div');
    track.className = 'slick-track';
    slides.forEach((slide) => {
      const wrapper = document.createElement('div');
      wrapper.className = 'slick-slide';
      wrapper.append(slide);
      track.append(wrapper);
    });
    list.append(track);

    const button = (cls, label) => {
      const el = document.createElement('button');
      el.type = 'button';
      el.className = `${cls} slick-arrow`;
      el.setAttribute('aria-label', label);
      el.textContent = label;
      return el;
    };
    const prev = button('slick-prev', 'Zurück');
    const next = button('slick-next', 'Weiter');
    const dots = document.createElement('ul');
    dots.className = 'slick-dots';

    root.classList.add('slick-slider', 'slick-initialized');
    root.replaceChildren(prev, list, next, dots);

    const wrappers = [...track.children];
    let index = 0;
    let perView = 1;

    const computePerView = () => {
      if (fade) return 1;
      const width = window.innerWidth;
      if (width <= 480) return 2;
      if (width <= 600) return 3;
      if (width <= 1024) return 4;
      return 5;
    };

    const pages = () => Math.ceil(wrappers.length / perView);

    const renderDots = () => {
      dots.replaceChildren();
      for (let page = 0; page < pages(); page += 1) {
        const li = document.createElement('li');
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.textContent = String(page + 1);
        dot.setAttribute('aria-label', `Seite ${page + 1}`);
        dot.addEventListener('click', () => go(page * perView));
        li.append(dot);
        dots.append(li);
      }
    };

    const update = () => {
      const page = Math.floor(index / perView);
      wrappers.forEach((wrapper, i) => {
        const visible = i >= index && i < index + perView;
        wrapper.classList.toggle('slick-active', visible);
        wrapper.setAttribute('aria-hidden', String(!visible));
        $$('a, button', wrapper).forEach((el) => { el.tabIndex = visible ? 0 : -1; });
      });
      if (!fade) {
        // Spur ist so breit wie alle Slides; jeder Slide nimmt 1/perView der sichtbaren Breite ein
        track.style.width = `${(wrappers.length / perView) * 100}%`;
        wrappers.forEach((wrapper) => { wrapper.style.width = `${100 / wrappers.length}%`; });
        track.style.transform = `translateX(-${(index / wrappers.length) * 100}%)`;
      }
      [...dots.children].forEach((li, i) => li.classList.toggle('slick-active', i === page));
    };

    function go(target) {
      const last = Math.max(0, (pages() - 1) * perView);
      if (fade) index = (target + wrappers.length) % wrappers.length;
      else index = target < 0 ? last : target > last ? 0 : target;
      update();
    }

    prev.addEventListener('click', () => go(index - perView));
    next.addEventListener('click', () => go(index + perView));

    const layout = () => {
      const before = perView;
      perView = computePerView();
      if (before !== perView) {
        index = Math.floor(index / perView) * perView;
        renderDots();
      }
      update();
    };
    perView = computePerView();
    renderDots();
    update();
    window.addEventListener('resize', layout);

    // Slideshow wechselt automatisch, außer bei Maus darüber oder reduzierter Bewegung
    if (fade && !reducedMotion) {
      let paused = false;
      root.addEventListener('mouseenter', () => { paused = true; });
      root.addEventListener('mouseleave', () => { paused = false; });
      root.addEventListener('focusin', () => { paused = true; });
      root.addEventListener('focusout', () => { paused = false; });
      setInterval(() => { if (!paused && !document.hidden) go(index + 1); }, 4000);
    }
  }

  /* ---------- Start ---------- */

  initDesignSwitcher();
  initCookieBanner();
  initMenu();
  initTabs();
  initViewSwitch();
  initClickableRows();
  initDialog();
  initLazyVideos();
  initScrolling();
  initSearch();
  $$('[data-carousel]').forEach(initCarousel);
})();
