# SSB Sumberharjo — Player Selection Decision Support System

A web-based Decision Support System (DSS) for **SSB Sumberharjo** football academy. Designed to help coaching staff objectively evaluate, track, and select players using a scientific, data-driven approach.

The system combines two algorithms: **Profile Matching** for gap analysis and **MOORA** (Multi-Objective Optimization on the basis of Ratio Analysis) to generate accurate player rankings based on positional requirements.

---

## Features

### Multi-Role Authentication
- **Admin** — Manages user access, coach accounts, player database, and algorithm parameters.
- **Coach** — Inputs player assessments, runs selection algorithms, and analyzes performance trends.

### Selection Engine (Hybrid Algorithm)
Evaluates players across 9 criteria in 3 aspects:

| Aspect | Criteria |
|---|---|
| Physical | Speed, Stamina, Strength |
| Technical | Passing, Dribbling, Shooting |
| Tactical | Positioning, Vision, Cooperation |

Core/Secondary Factor weights and MOORA parameters are configurable via the Admin dashboard.

### Analytics & Reporting
- **Visual Dashboards** — Line charts (performance history) and radar charts (attribute mapping) via Chart.js.
- **PDF Export** — Generates official evaluation reports using DomPDF.
- **Real-Time Notifications** — Database-driven notifications to synchronize coaches and admins on key events.

### UI/UX
- Built with Tailwind CSS — responsive, clean, and optimized for readability.
- Features split-screen authentication views, interactive sidebar, and soft-color themes.

---

## Technology Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11 (PHP) |
| Database | MySQL |
| Frontend | Tailwind CSS |
| Icons | SVG Heroicons |
| Charts | Chart.js |
| PDF | barryvdh/laravel-dompdf |

---

## Installation

**1. Clone the repository**
```bash
git clone https://github.com/fredli4qooni/ssb_sumberharjo_dss.git
cd ssb_sumberharjo_dss
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install frontend dependencies**
```bash
npm install
npm run build
```

**4. Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

Configure your database credentials in the `.env` file.

**5. Run migrations and seeders**
```bash
php artisan migrate:fresh --seed
```

**6. Serve the application**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## Usage

1. **Setup Parameters (Admin)** — Set MOORA weights (W1, W2, W3) and Profile Matching percentages (Core & Secondary Factors) in the DSS Parameter menu.
2. **Register Players (Admin)** — Input new academy players into the database.
3. **Assess Players (Coach)** — Select an active session and input scores (1–5) for each player.
4. **Run Selection (Coach)** — Choose a target position and let the algorithm calculate rankings.
5. **Analyze & Export (Coach)** — View visual analytics and download the PDF report.

---

## License

This project is open-source and available under the [MIT License](LICENSE).