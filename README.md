# non-functional php webshop, horrid code looking back at it but i still take pride in it

## Functions:
- Display all products on front page
- Admin Panel:
  - Managing Administrators
  - Managing Products
  - Managing Product Categories
  - Managing Customers

 
## File Structure:
```
webshop.php
├───webshop
│   ├───admin
│   │   ├───categories
│   │   │   ├───add_category.php
│   │   │   ├───delete_category.php
│   │   │   ├───edit_category.php
│   │   │   └───index.php
│   │   ├───core
│   │   │   ├───checklogin_admin.php
│   │   │   ├───footer.php
│   │   │   └───header.php
│   │   ├───customers
│   │   │   ├───add_customer.php
│   │   │   ├───delete_customer.php
│   │   │   ├───edit_customer.php
│   │   │   └───index.php
│   │   ├───products
│   │   │   ├───add_product.php
│   │   │   ├───delete_product.php
│   │   │   ├───edit_product.php
│   │   │   └───index.php
│   │   ├───users
│   │   │   ├───add_user.php
│   │   │   ├───delete_user.php
│   │   │   ├───edit_user.php
│   │   │   └───index.php
│   │   ├───forgot_password.php
│   │   ├───index.php
│   │   ├───logout.php
│   │   └───verify_password.php
│   ├───assets
│   │   ├───css
│   │   │   ├───_crud.scss
│   │   │   ├───_layout.scss
│   │   │   ├───_login.scss
│   │   │   ├───_navigation.scss
│   │   │   ├───_normalize.scss
│   │   │   ├───style.css
│   │   │   └───style.scss
│   │   ├───img
│   │   │   └───input_icons.png
│   │   └───js
│   │   │   └───quantity.js
│   ├───core
│   │   ├───db_connect.php
│   │   ├───footer.php
│   │   └───header.php
│   └───database
│   │   └───webshop.sql
│   ├───.htaccess
│   ├───contact.php
│   ├───index.php
│   └───product.php
├───.gitignore
└───README.md
```

## Code Formatting:
### HTML:
#### Protocol
```html
<!-- Not recommended: omits the protocol -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Not recommended: uses HTTP -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
```
```html
<!-- Recommended -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
```
```css
/* Not recommended: omits the protocol */
@import '//fonts.googleapis.com/css?family=Open+Sans';

/* Not recommended: uses HTTP */
@import 'http://fonts.googleapis.com/css?family=Open+Sans';
```
```css
/* Recommended */
@import 'https://fonts.googleapis.com/css?family=Open+Sans';
```
#### Indentation
```html
<ul>
  <li>Fantastic
  <li>Great
</ul>
```
```css
.example {
  color: blue;
}
```
#### Capitalization
```html
<!-- Not recommended -->
<A HREF="/">Home</A>
```
```html
<!-- Recommended -->
<img src="google.png" alt="Google">
```
```css
/* Not recommended */
color: #E5E5E5;
```
```css
/* Recommended */
color: #e5e5e5;
```
#### HTML Validity
```html
<!-- Not recommended -->
<title>Test</title>
<article>This is only a test.
```
```html
<!-- Recommended -->
<!DOCTYPE html>
<meta charset="utf-8">
<title>Test</title>
<article>This is only a test.</article>
```
#### Semantics
```html
<!-- Not recommended -->
<div onclick="goToRecommendations();">All recommendations</div>
```
```html
<!-- Recommended -->
<a href="recommendations/">All recommendations</a>
```
#### Multimedia Fallback
```html
<!-- Not recommended -->
<img src="spreadsheet.png">
```
```html
<!-- Recommended -->
<img src="spreadsheet.png" alt="Spreadsheet screenshot.">
```
#### Separation of Concerns
```html
<!-- Not recommended -->
<!DOCTYPE html>
<title>HTML sucks</title>
<link rel="stylesheet" href="base.css" media="screen">
<link rel="stylesheet" href="grid.css" media="screen">
<link rel="stylesheet" href="print.css" media="print">
<h1 style="font-size: 1em;">HTML sucks</h1>
<p>I’ve read about this on a few sites but now I’m sure:
  <u>HTML is stupid!!1</u>
<center>I can’t believe there’s no way to control the styling of
  my website without doing everything all over again!</center>
```
```html
<!-- Recommended -->
<!DOCTYPE html>
<title>My first CSS-only redesign</title>
<link rel="stylesheet" href="default.css">
<h1>My first CSS-only redesign</h1>
<p>I’ve read about this on a few sites but today I’m actually
  doing it: separating concerns and avoiding anything in the HTML of
  my website that is presentational.
<p>It’s awesome!
```
#### Entity References
```html
<!-- Not recommended -->
The currency symbol for the Euro is &ldquo;&eur;&rdquo;.
```
```html
<!-- Recommended -->
The currency symbol for the Euro is “€”.
```
#### `type` Attributes
```html
<!-- Not recommended -->
<link rel="stylesheet" href="https://www.google.com/css/maia.css"
    type="text/css">
```
```html
<!-- Recommended -->
<link rel="stylesheet" href="https://www.google.com/css/maia.css">
```
```html
<!-- Not recommended -->
<script src="https://www.google.com/js/gweb/analytics/autotrack.js"
    type="text/javascript"></script>
```
```html
<!-- Recommended -->
<script src="https://www.google.com/js/gweb/analytics/autotrack.js"></script>
```
#### HTML Quotation Marks
```html
<!-- Not recommended -->
<a class='maia-button maia-button-secondary'>Sign in</a>
```
```html
<!-- Recommended -->
<a class="maia-button maia-button-secondary">Sign in</a>
```

### CSS:
#### ID and Class Naming
```css
/* Not recommended: meaningless */
#yee-1901 {}

/* Not recommended: presentational */
.button-green {}
.clear {}
```
```css
/* Recommended: specific */
#gallery {}
#login {}
.video {}

/* Recommended: generic */
.aux {}
.alt {}
```
#### ID and Class Name Style
```css
/* Not recommended */
#navigation {}
.atr {}
```
```css
/* Recommended */
#nav {}
.author {}
```
#### Type Selectors
```css
/* Not recommended */
ul#example {}
div.error {}
```
```css
/* Recommended */
#example {}
.error {}
```
#### Shorthand Properties
```css
/* Not recommended */
border-top-style: none;
font-family: palatino, georgia, serif;
font-size: 100%;
line-height: 1.6;
padding-bottom: 2em;
padding-left: 1em;
padding-right: 1em;
padding-top: 0;
```
```css
/* Recommended */
border-top: 0;
font: 100%/1.6 palatino, georgia, serif;
padding: 0 1em 2em;
```
#### Hexadecimal Notation
```css
/* Not recommended */
color: #eebbcc;
```
```css
/* Recommended */
color: #ebc;
```
#### ID and Class Name Delimiters
```css
/* Not recommended: does not separate the words “demo” and “image” */
.demoimage {}

/* Not recommended: uses underscore instead of hyphen */
.error_status {}
```
```css
/* Recommended */
#video-id {}
.ads-sample {}
```
