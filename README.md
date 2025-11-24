# Wordpress petition page template

Re-factoring of a standalone PHP application as a Wordpress custom page template for the NAEC website.

The [original](original/) application, supplied by Michael Hawley, provided a simple petition (operating rather like a website guestbook feature) for the abatement of the Sullivan Courthouse redevelopment proposal at 40 Thorndike.

## Usage

The NAEC site uses a Wordpress theme called Solo. This template is integrated with Solo by using a child theme called [solo-child](solo-child/). Place this directory into the Wordpress `wp-content/themes` directory as a peer of the existing Solo theme.

The entries submitted for the petition are stored in a petition file under [db](db/).

This Wordpress template uses simple honeypot field and time restriction methods for reducing email spam bots instead of a CAPTCHA based system.

The status messages returned by the petition submission form can be edited in the `petition_status_messages.php` file under [solo-child/includes](solo-child/includes/).

## References

* [Neighborhood Association for East Cambridge (NAEC)](http://NAeastCambridge.org)
* [Solo Theme for Wordpress](http://themetrust.com/themes/solo)
