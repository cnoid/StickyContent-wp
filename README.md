# StickyContent-wp
Make an automatic Sticky "Table of Content" sidebar on WordPress pages, which can be useful if your theme or plugins (such as heavy caching) doesn't support certain aspects.

Usage is simple. Select your version first:

- Main: This is the standard, and should be used for just about everyone.
- TrPs: This is modified for TranslatePress and has a polling function to wait for TranslatePress. This should work without TranslatePress, but I have not tested it.



Create a new sidebar in your widgets/themes, and select HTML block.

In this block, create a title for it (if you want) as well as pasting in this code: `<div class="scStickyContentTable"></div>`

For mobile, do the same thing except at the top of the page (or wherever you wish) put `<div class="scStickyContentTableMobile">Contents:</div>`

Note that the mobile is not sticky, for good reasons.



Next, you'll want to assign your `<h2>` and `<h3>` classes some ID tags so it scrolls the user to the location of those tags. This is modifiable to be `<h1>` or similar - simply inspect the code and look for the note.

The plugin will then print out a `<table>` which can be stylized using `<td>` and `<tr>`. The links to the items are simple `<a href="#idofyourh2tag">Title between the h2 tag</a>` so you can also style them accordingly.

