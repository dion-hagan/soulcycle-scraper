# SoulCycle Class Booking Automation

This project automates the process of booking SoulCycle classes using PHP and Laravel Dusk for browser automation. It can run both locally for debugging and via GitHub Actions for automated scheduling.

## Features

- Automated login to SoulCycle account
- Class booking automation
- Configurable class preferences via environment variables
- Supports both headless (GitHub Actions) and non-headless (local debugging) modes
- Daily automated booking attempts via GitHub Actions

## Requirements

- PHP 8.2+
- Composer
- Chrome/Chromium browser
- Git

## Installation

1. Clone the repository:
```bash
git clone [your-repo-url]
cd soulcycle-scraper
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Configure your `.env` file with your SoulCycle credentials and preferences:
```
SOULCYCLE_EMAIL=your-email@example.com
SOULCYCLE_PASSWORD=your-password
DESIRED_CLASS_TIME=your-preferred-time
DESIRED_LOCATION=your-preferred-location
```

## Usage

### Local Development (Non-headless mode)

For debugging and development, run the command locally to see the browser automation in action:

```bash
php application soulcycle:book
```

This will open a Chrome browser window and execute the booking process visibly.

### GitHub Actions (Headless mode)

The project includes a GitHub Actions workflow that runs automatically every day at 10:00 UTC. The workflow:

1. Sets up PHP and Chrome in the GitHub Actions environment
2. Installs dependencies
3. Configures environment variables from GitHub Secrets
4. Runs the booking command in headless mode

To configure automated booking:

1. Go to your GitHub repository settings
2. Navigate to Secrets and Variables > Actions
3. Add the following secrets:
   - `SOULCYCLE_EMAIL`
   - `SOULCYCLE_PASSWORD`
   - `DESIRED_CLASS_TIME`
   - `DESIRED_LOCATION`

You can also manually trigger the workflow through the GitHub Actions tab using the "workflow_dispatch" event.

## Development

The main booking logic is in `app/Commands/BookSoulCycleClass.php`. The command uses Laravel Dusk for browser automation and supports both headless and non-headless modes.

To modify the booking logic or add new features:

1. Update the `BookSoulCycleClass.php` file
2. Test locally in non-headless mode to verify changes
3. Commit and push changes
4. Verify the GitHub Actions workflow succeeds

## License

MIT License
