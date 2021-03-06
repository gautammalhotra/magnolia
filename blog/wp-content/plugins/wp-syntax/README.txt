=== WP-Syntax ===
Contributors: rmm5t
Donate link: http://ryan.mcgeary.org/wp-syntax/
Tags: syntax highlighting, syntax, highlight, code, formatting
Requires at least: 2.0
Tested up to: 2.5.1
Stable tag: 0.8

WP-Syntax provides clean syntax highlighting for embedding source code within pages or posts.

== Description ==

WP-Syntax provides clean syntax highlighting using
[GeSHi](http://qbnz.com/highlighter/) -- supporting a wide range of popular
languages.  It supports highlighting with or
without line numbers and maintains formatting while copying snippets of code
from the browser.

It avoids conflicts with other 3rd party plugins by running an early
pre-filter and a late post-filter that substitutes and pulls the code snippets
out first and then pushes them back in with highlighting at the end.  The
result is source code formatted and highlighted the way you intended.

This plugin was originally written for use with
[EmacsBlog](http://www.emacsblog.org).  To see it in action, scroll through
this [particular
post](http://www.emacsblog.org/2007/02/22/maximize-on-startup-part-2/) or
visit the
[screenshots](http://wordpress.org/extend/plugins/wp-syntax/screenshots/).

Usage, Supported Languages, Styling Guidelines, and Release Notes are availabe
in the [Other
Notes](http://wordpress.org/extend/plugins/wp-syntax/other_notes/) section.

= Basic Usage =

Wrap code blocks with `<pre lang="LANGUAGE" line="1">` and `</pre>` where
`LANGUAGE` is a [GeSHi](http://qbnz.com/highlighter/) supported language
syntax.  The `line` attribute is optional.  [More usage
examples](http://wordpress.org/extend/plugins/wp-syntax/other_notes/)

== Installation ==

1. Upload wp-syntax.zip to your Wordpress plugins directory, usually `wp-content/plugins/` and unzip the file.  It will create a `wp-content/plugins/wp-syntax/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Create a post/page that contains a code snippet following the [proper usage syntax](http://wordpress.org/extend/plugins/wp-syntax/other_notes/).

== Frequently Asked Questions ==

= Why is the plugin generating strange output? =

Try editing code snippets without the visual editor.  To turn off the visual
editor for all your edits, uncheck the visual editor checkbox in your profile.
Depending on what type of code you're trying to display, you might also need
to disable WordPress' corrections of invalidly nested XMTML (under Options ->
Writing).

== Screenshots ==

1. PHP, no line numbers.
2. Java, with line numbers.
3. Ruby, with line numbers starting at 18.

== Usage ==

Wrap code blocks with `<pre lang="LANGUAGE" line="1">` and `</pre>` where
`LANGUAGE` is a [GeSHi](http://qbnz.com/highlighter/) supported language
syntax.  See below for a full list of supported languages.  The `line`
attribute is optional.

**Example 1: PHP, no line numbers**

    <pre lang="php">
    <div id="foo">
    <?php
      function foo() {
        echo "Hello World!\\n";
      }
    ?>
    </div>
    </pre>


**Example 2: Java, with line numbers**

    <pre lang="java" line="1">
    public class Hello {
      public static void main(String[] args) {
        System.out.println("Hello World!");
      }
    }
    </pre>

**Example 3: Ruby, with line numbers starting at 18**

    <pre lang="ruby" line="18">
    class Example
      def example(arg1)
        return "Hello: " + arg1.to_s
      end
    end
    </pre>

== Supported Languages ==

The following languages are supported in the `lang` attribute:

abap, actionscript, actionscript3, ada, apache, applescript, asm, **asp**,
autoit, **bash**, blitzbasic, bnf, **c**, c_mac, caddcl, cadlisp, cfdg, cfm,
cpp-qt, **cpp**, **csharp**, **css**, d, delphi, diff, div, dos, dot, eiffel,
fortran, freebasic, genero, gettext, glsl, gml, groovy, haskell,
**html4strict**, idl, ini, inno, io, **java**, **java5**, **javascript**,
kixtart, latex, lisp, lotusformulas, lotusscript, lua, m68k, matlab, mirc,
mpasm, mxml, **mysql**, nsis, **objc**, ocaml-brief, ocaml, oobas, **oracle8**,
pascal, per, **perl**, php-brief, **php**, plsql, **python**, qbasic, **rails**,
reg, robots, **ruby**, sas, scala, scheme, sdlbasic, smalltalk, smarty, **sql**,
tcl, text, thinbasic, tsql, **vb**, **vbnet**, verilog, vhdl, visualfoxpro,
winbatch, **xml**, xpp, z80

(Bold languages just highlight the more popular ones.)

== Styling Guidelines ==

WP-Syntax colors code using the default GeSHi colors.  It also uses inline
styling to make sure that code highlights still work in RSS feeds.  It uses a
default `wp-syntax.css` stylesheet for basic layout.  To customize your styling,
copy the default `wp-content/plugins/wp-syntax/wp-syntax.css` to your theme's
template directory and modify it.  If a file named `wp-syntax.css` exists in
your theme's template directory, this stylesheet is used instead of the default.
This allows theme authors to add their own customizations as they see fit.

== Advanced Customization ==

WP-Syntax supports a `wp_syntax_init_geshi` action hook to customize GeSHi
initialization settings.  Blog owners can handle the hook in a hand-made plugin
or somewhere else like this:

    <?php
    add_action('wp_syntax_init_geshi', 'my_custom_geshi_styles');

    function my_custom_geshi_styles(&$geshi)
    {
        $geshi->set_brackets_style('color: #000;');
        $geshi->set_keyword_group_style(1, 'color: #22f;');
    }
    ?>

This allows for a great possibility of different customizations.  Be sure to
review the [GeSHi Documentation](http://qbnz.com/highlighter/geshi-doc.html).

== Release Notes ==

**0.8** : Updated to use GeSHi v1.0.7.21 (this normally would be a revision
  release, but colors changed and there are 9 new languages supported); Added a
  font-size setting in the default css to thwart complaints about small sizes
  caused by other default WP themes;

**0.7** : Automaticaly included common styles without requiring manual theme
  customization [Christian Heim]; Added support for adding a custom
  wp-syntax.css stylesheet to a theme;

**0.6.1** : Updated to use GeSHi v1.0.7.21; Updated the WP compatibility version;

**0.6** : Support init hook for geshi settings (`wp_syntax_init_geshi`);
  ([#667](http://dev.wp-plugins.org/ticket/667))
  [[reedom](http://wordpress.org/support/topic/125127?replies=1#post-586215)]

**0.5.4** : Updated to use GeSHi v1.0.7.20;

**0.5.3** : Fixed styling guideline issue that affected IE 6 [kimuraco];

**0.5.2** : Updated to use GeSHi v1.0.7.19;

**0.5.1** : Switched `geshi` directory export to utilize
  [piston](http://piston.rubyforge.org/) instead of `svn:externals` properties;

**0.5** : Added support for single quoted attributes;
  ([#624](http://dev.wp-plugins.org/ticket/624))

**0.4** : Cleanup and documentation for WordPress.org [plugin
  listings](http://wordpress.org/extend/plugins/);

**0.3** : First official public release; Added line number support; Uses GeSHi v1.0.7.18;
([#532](http://dev.wp-plugins.org/ticket/532))

**0.2** : Internal release; Adds "before and after" filter support to avoid
conflicts with other plugins;
([#531](http://dev.wp-plugins.org/ticket/531))

**0.1** : First internal release; Uses GeSHi v1.0.7.16;
