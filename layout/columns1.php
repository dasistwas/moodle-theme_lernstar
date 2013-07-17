<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
$html = theme_lernstar_get_html_for_settings($OUTPUT, $PAGE);

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>


<div id="page" class="container-fluid">

	<div id="page" class="container-fluid">
		<header role="banner" id="page-header">
			<div class="row-fluid">
				<div class="logo span7">
					<a class="logo" href="<?php echo $CFG->wwwroot; ?>"
						title="<?php print_string('home'); ?>"></a>
					<h1>
						<?php echo $PAGE->heading ?>
					</h1>
				</div>
				<div class="span5">
					<div>
						<ul class="nav">
							<li><?php echo $OUTPUT->page_heading_menu(); ?></li>
							<li class="navbar-text clearfix"><?php echo $OUTPUT->theme_lernstar_socialicons(); ?></li>
							<?php if (!($OUTPUT->custom_menu() === "")){ ?>
							<li class="clearfix">
								<nav role="navigation">
									<div class="nav-collapse collapse">
										<?php echo $OUTPUT->custom_menu(); ?>
									</div>
								</nav>
							</li>
							<?php } ?>
							<li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="page-navbar">
				<nav class="breadcrumb-button">
					<?php echo $OUTPUT->page_heading_button(); ?>
				</nav>
				<?php echo $OUTPUT->navbar(); ?>
			</div>
		</header>
	
    <div id="page-content">
        <div id="region-bs-main-and-pre">
            <section id="region-main">
                <?php
                echo $OUTPUT->course_content_header();
                echo $OUTPUT->main_content();
                echo $OUTPUT->course_content_footer();
                ?>
            </section>
        </div>
    </div>

    <footer id="page-footer">
    	<?php echo $html->footnote; ?>
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <div class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></div>
        <?php
        	echo $OUTPUT->standard_footer_html();
        ?>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
