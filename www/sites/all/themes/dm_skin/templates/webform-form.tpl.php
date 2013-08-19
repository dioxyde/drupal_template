<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 */
?>
<div class="formulaire">
  <?php
    // Print out the main part of the form.
    // Feel free to break this up and move the pieces within the array.
    print drupal_render($form['submitted']);

    // Always print out the entire $form. This renders the remaining pieces of the
    // form that haven't yet been rendered above.
    print drupal_render_children($form);
  ?>
</div>
