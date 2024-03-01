![Gistlog logo](https://raw.githubusercontent.com/tighten/gistlog/main/gistlog-banner.png)

# GistLog

> [!IMPORTANT]
> Gistlog was an app that turned your GitHub Gists into shareable blog posts.  Due to waning interest we have decided to shut down Gistlog.

---

Turn your gists into easy, beautiful, responsive blog posts--each a "GistLog". Just paste a Gist URL into [GistLog.co](https://gistlog.co/) and you're up and running.

You can also just replace `gist.github.com` in any URL with `gistlog.co`, and you instantly have a beautiful GistLog.

## Requirements

 * PHP >= 7.4
 * Composer

## Installation

1. Clone the repository locally
2. Install dependencies with `composer install`
3. Copy `.env.example` to `.env` and modify its contents to reflect your local environment
4. Generate application key
```bash
php artisan key:generate
```
5. Configure a web server, such as the built-in PHP web server, to serve this site using the +public+ directory as its root
```bash
php -S localhost:8080 -t public
```
6. Go to https://github.com/settings/developers and create a Oauth app
7. Create a token here https://github.com/settings/tokens that has access right to Gist

## Questions
If you have any questions, please reach out to [@mattstauffer](https://github.com/mattstauffer). Find him here or on twitter at [@stauffermatt](https://twitter.com/stauffermatt).

## Contributing

Please see the [contributing.md](https://github.com/tighten/gistlog/blob/main/contributing.md) for more explicit instructions on how to contribute to the project.

If you have an idea for the project, please look at the [open issues](https://github.com/tighten/gistlog/issues), and if your idea isn't there, open an issue for discussion.You can write a pull request without validating the idea first, but it will open up the possibility that you spend a lot of time writing a feature and it gets rejected.
