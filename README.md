# WebSpace WordPress Theme

This WordPress theme is designed to create a custom "Skills" and "Projects" post type, along with custom fields for the homepage and projects.

## Getting Started

To get started with the WebSpace WordPress theme, follow these steps:

1. Navigate to the `/wp-content/themes/` folder in your WordPress installation.
2. Clone this repository `git clone git@github.com:web-space-dev/website-backend-theme.git`
3. Log in to your WordPress admin dashboard.
4. Go to "Appearance" > "Themes".
5. Find the "WebSpace" theme and click on the "Activate" button.

## Database Syncing

To export your current database to add to version control, open a site shell in Local, and run the following command:

```bash
wp db export --add-drop-table database.sql
```

To import the database from version control, open a site shell in Local, and run the following command:

```bash
wp db import database.sql
```

## License

This WordPress theme is released under the [MIT License](LICENSE).
