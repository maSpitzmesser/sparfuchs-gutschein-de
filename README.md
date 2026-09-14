# Sparfuchs Gutschein

WordPress-Installation für Sparfuchs-Gutschein.de mit lokaler Entwicklungsumgebung.

## Setup

### Voraussetzungen
- Docker & Docker Compose installiert
- PHP 8.2+

### Lokale Entwicklung starten

```bash
# 1. Docker Compose Services starten
docker-compose up -d

# 2. WordPress ist verfügbar unter http://localhost:8080

# Admin-Login
URL: http://localhost:8080/wp-admin
Benutzer: admin
Passwort: admin123
```

### Datenbank
- **Host**: mysql (im Docker-Netzwerk: localhost:3307)
- **Benutzer**: wordpress
- **Passwort**: wordpress
- **Datenbank**: wordpress_local

### Befehle

```bash
# Logs anschauen
docker-compose logs -f wordpress

# Container stoppen
docker-compose down

# Datenbank von vorne
docker-compose down -v  # Löscht auch Volumes
docker-compose up -d
```
