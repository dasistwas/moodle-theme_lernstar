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

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}
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
<div class="container-fluid container-design">
	<div id="page" class="container-fluid">
		<header id="page-header">
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
<?php
if (exists_auth_plugin('googleoauth2')) {
    $loginpage = ((string)$this->page->url === get_login_url());
    if (!empty($loginpage) || $PAGE->course->id == 1) {
        require_once($CFG->dirroot . '/auth/googleoauth2/lib.php');
        auth_googleoauth2_display_buttons();
    }
}
?>
    <div id="page-content" class="row-fluid">
        <div id="<?php echo $regionbsid ?>" class="span9">
            <div class="row-fluid">
                <section id="region-main" class="span8 pull-right">
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
    </div>

		<footer id="page-footer">
		<?php echo $html->footnote; ?>
			<div id="course-footer">
				<?php echo $OUTPUT->course_footer(); ?>
			</div>
			<div class="helplink">
				<?php echo $OUTPUT->page_doc_link(); ?>
			</div>
			<?php
			echo $OUTPUT->standard_footer_html();
			echo theme_lernstar_copyright();
			?>
		</footer>
		<?php echo $OUTPUT->standard_end_of_body_html() ?>
	</div>
	</div>
</body>
</html>
