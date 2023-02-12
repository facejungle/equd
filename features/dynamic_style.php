<?php
/**
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class for basic theme settings: theme_supports, menu registration, file extension, image size.
 *
 * @category EQUD_Settings class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class dynamic_style {

	public function __construct() {
		add_action('wp_head', array($this, 'reset_style'));
		add_action('wp_head', array($this, 'root_style'));
		add_action('wp_head', array($this, 'calculate_style'));
		add_action('wp_head', array($this, 'fonts_style'));
		add_action('wp_head', array($this, 'print_css'));
	}

	function print_css() {
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<script>
			loadCSS( "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" );
		</script>
		<?php
	}
	public function root_style() {
		?>
	  <style>
		 :root {
			/* 
			____________________________________________________

			-----> > > Colors, shadows and borders < < <-----
			____________________________________________________

			*/
			--color_dynamic: #CCC;
			--color_dynamic_alt: #eee;

			--color_white: #FCFCFC;
			--color_gray0: #f0f0f0;
			--color_gray: #CCC;
			--color_black: #333;
			--color_green: #2eaa53;
			--color_red: #aa2e49;
			--color_blue: #2e55aa;

			--color_black_trans0: rgba(0, 0, 0, 0.2);
			--color_black_trans1: rgba(0, 0, 0, 0.4);
			--color_black_trans2: rgba(0, 0, 0, 0.6);
			/* Shadows */
			--shadow_block: 0 8px 8px -8px rgba(0, 0, 0, .3);
			--shadow_text: 0 3px 6px rgba(0, 0, 0, .5);
			/* Borders */
			--border: 1px solid rgba(0, 0, 0, .2);
			--radius: 10px;

			--ellipse: 50% 20% / 10% 40%;

			/* 
			____________________________________________________

			-----> > > Fonts < < <-----
			____________________________________________________

			*/

			--font_montserrat: "Montserrat", verdana, sans-serif;
			font-family: var(--font_montserrat);
			-webkit-font-smoothing: subpixel-antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-rendering: optimizelegibility;
		 }
	  </style>
		<?php
	}

	public function fonts_style() {
		?>
	  <style>
		 @font-face {
			font-size: 18px;
			font-display: swap;
			font-family: "Montserrat", Verdana, sans-serif;
			src: local("Montserrat"), url("/wp-content/themes/equd/assets/fonts/Montserrat-VariableFont_wght.ttf") format("truetype");
		 }
	  </style>
		<?php
	}

	public function calculate_style() {
		?>
	  <style>
		 @media only screen and (max-width: 480px) {
			:root {
			   --padding25: 12.5px;
			   --padding50: 25px;
			   --padding100: 50px;
			   --margin_calc: 25px;
			   --container_px: 480px;
			   --total_container_width: calc(100vw - (var(--padding50)));
			}
		 }

		 @media only screen and (min-width: 481px) and (max-width: 1366px) {
			:root {
			   --nominal_screen: 1366;
			   --container_px: 1100px;
			   --target_screen: 480;
			   --target_screen_px: 380px;

			   --total_container_width: calc(var(--container_px) + (var(--padding25) * 2));
			   --coefficient: calc((100vw - var(--target_screen_px)) / (var(--nominal_screen) - var(--target_screen)));
			   --padding25: calc((var(--coefficient) * 6) + 12.5px);
			   --padding50: calc((var(--coefficient) * 12.5) + 25px);
			   --padding100: calc((var(--coefficient) * 25) + 50px);
			   --margin_calc: calc((var(--coefficient) * 25) + 50px);
			}
		 }

		 @media only screen and (min-width: 1367px) and (max-width: 1920px) {
			:root {
			   --nominal_screen: 1920;
			   --container_px: 1520px;
			   --target_screen: 1367;
			   --target_screen_px: 1367px;

			   --total_container_width: calc(var(--container_px) + (var(--padding25) * 2));
			   --coefficient: calc((100vw - var(--target_screen_px)) / (var(--nominal_screen) - var(--target_screen)));
			   --padding25: calc((var(--coefficient) * 6.5) + 18.5px);
			   --padding50: calc((var(--coefficient) * 12.5) + 37.5px);
			   --padding100: calc((var(--coefficient) * 25) + 75px);
			   --margin_calc: calc((var(--coefficient) * 50) + 150px);
			}
		 }
	  </style>
		<?php
	}
	public function reset_style() {
		?>
	  <style>
		 html, body, div, span, applet, object, iframe,
		 h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		 a, abbr, acronym, address, big, cite, code,
		 del, dfn, em, img, ins, kbd, q, s, samp,
		 small, strike, strong, sub, sup, tt, var,
		 b, u, i, center,
		 dl, dt, dd, ol, ul, li,
		 fieldset, form, label, legend,
		 table, caption, tbody, tfoot, thead, tr, th, td,
		 article, aside, canvas, details, embed,
		 figure, figcaption, footer, header, hgroup,
		 menu, nav, output, ruby, section, summary,
		 time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		 }
		 :focus {
			outline: 0;
		 }
		 article, aside, details, figcaption, figure,
		 footer, header, hgroup, menu, nav, section {
			display: block;
		 }
		 body {
			line-height: 1;
		 }
		 ol, ul {
			list-style: none;
		 }
		 blockquote, q {
			quotes: none;
		 }
		 blockquote:before, blockquote:after,
		 q:before, q:after {
			content: '';
			content: none;
		 }
		 table {
			border-collapse: collapse;
			border-spacing: 0;
		 }
		 input[type=search]::-webkit-search-cancel-button,
		 input[type=search]::-webkit-search-decoration,
		 input[type=search]::-webkit-search-results-button,
		 input[type=search]::-webkit-search-results-decoration {
			-webkit-appearance: none;
			-moz-appearance: none;
		 }
		 input[type=search] {
			-webkit-appearance: none;
			-moz-appearance: none;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
		 }
		 textarea {
			overflow: auto;
			vertical-align: top;
			resize: vertical;
		 }
		 audio,
		 canvas,
		 video {
			display: inline-block;
			*display: inline;
			*zoom: 1;
			max-width: 100%;
		 }
		 audio:not([controls]) {
			display: none;
			height: 0;
		 }
		 [hidden] {
			display: none;
		 }
		 html {
			font-size: 100%; /* 1 */
			-webkit-text-size-adjust: 100%; /* 2 */
			-ms-text-size-adjust: 100%; /* 2 */
		 }
		 a {
			color: #333;
			text-decoration: none;
		 }
		 a:focus {
			outline: thin dotted;
		 }
		 a:active,
		 a:hover {
			text-decoration: underline;
			outline: 0;
		 }
		 img {
			border: 0; /* 1 */
			-ms-interpolation-mode: bicubic; /* 2 */
		 }
		 figure {
			margin: 0;
		 }
		 form {
			margin: 0;
		 }
		 fieldset {
			border: 1px solid #c0c0c0;
			margin: 0 2px;
			padding: 0.35em 0.625em 0.75em;
		 }
		 legend {
			border: 0; /* 1 */
			padding: 0;
			white-space: normal; /* 2 */
			*margin-left: -7px; /* 3 */
		 }
		 button,
		 input,
		 select,
		 textarea {
			font-size: 100%; /* 1 */
			margin: 0; /* 2 */
			vertical-align: baseline; /* 3 */
			*vertical-align: middle; /* 3 */
		 }
		 button,
		 input {
			line-height: normal;
		 }
		 button,
		 select {
			text-transform: none;
		 }
		 button,
		 html input[type="button"], /* 1 */
		 input[type="reset"],
		 input[type="submit"] {
			-webkit-appearance: button; /* 2 */
			cursor: pointer; /* 3 */
			*overflow: visible;  /* 4 */
		 }
		 button[disabled],
		 html input[disabled] {
			cursor: default;
		 }
		 input[type="checkbox"],
		 input[type="radio"] {
			box-sizing: border-box; /* 1 */
			padding: 0; /* 2 */
			*height: 13px; /* 3 */
			*width: 13px; /* 3 */
		 }
		 input[type="search"] {
			-webkit-appearance: textfield; /* 1 */
			-moz-box-sizing: content-box;
			-webkit-box-sizing: content-box; /* 2 */
			box-sizing: content-box;
		 }
		 input[type="search"]::-webkit-search-cancel-button,
		 input[type="search"]::-webkit-search-decoration {
			-webkit-appearance: none;
		 }
		 button::-moz-focus-inner,
		 input::-moz-focus-inner {
			border: 0;
			padding: 0;
		 }
		 textarea {
			overflow: auto; /* 1 */
			vertical-align: top; /* 2 */
		 }
		 table {
			border-collapse: collapse;
			border-spacing: 0;
		 }
		 html,
		 button,
		 input,
		 select,
		 textarea {
			color: #222;
		 }
		 ::-moz-selection {
			background: #b3d4fc;
			text-shadow: none;
		 }
		 ::selection {
			background: #b3d4fc;
			text-shadow: none;
		 }
		 img {
			vertical-align: middle;
		 }
		 fieldset {
			border: 0;
			margin: 0;
			padding: 0;
		 }
		 textarea {
			resize: vertical;
		 }
		 .chromeframe {
			margin: 0.2em 0;
			background: #ccc;
			color: #000;
			padding: 0.2em 0;
		 }
	  </style>
		<?php
	}
}
