<?php
/**
 * Oceaneyes
 *
 *
 * @todo document
 * @file
 * @ingroup Skins
 * @author Guo Yunhe<guoyunhebrave@gmail.com>
 */
if (! defined ( 'MEDIAWIKI' ))
	die ( - 1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 *
 * @todo document
 *       @TODO what's addModuleStyles for
 *       @ingroup Skins
 */
class SkinOceaneyes extends SkinTemplate {
	/**
	 * Using Oceaneyes.
	 */
	var $skinname = 'oceaneyes', $stylename = 'oceaneyes', $template = 'OceaneyesTemplate', $useHeadElement = true;
	function setupSkinUserCss(OutputPage $out) {
		global $wgHandheldStyle;
		parent::setupSkinUserCss ( $out );
		
		$out->addModuleStyles( 'skins.oceaneyes' );
		
		// Ugh. Can't do this properly because $wgHandheldStyle may be a URL
		if ($wgHandheldStyle) {
			// Currently in testing... try 'chick/main.css'
			$out->addStyle ( $wgHandheldStyle, 'handheld' );
		}
		
		// TODO: Migrate all of these
		$out->addStyle ( 'oceaneyes/main.css', 'screen' );
	}
}
/**
 *
 * @todo document
 *       @ingroup Skins
 */
class OceaneyesTemplate extends BaseTemplate {
	
	/**
	 * Template filter callback for Oceaneyes skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgStylePath;
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings ();
		
		$this->html ( 'headelement' );
		?>
<script src="<?php echo $wgStylePath ?>/oceaneyes/jquery.scrollTo.js"></script>
<script src="<?php echo $wgStylePath ?>/oceaneyes/isInViewport.min.js"></script>
<script src="<?php echo $wgStylePath ?>/oceaneyes/main.js"></script>
<!-- Header -->
<div id="header">
	<!-- optimize your site header here, such as logo, site name, menu, etc. -->
</div>
<!-- End of Header -->
<!-- Toolbar -->
<div id="tool-bar">
	<div id="tool-bar-inner">
		<form action="<?php $this->text('wgScript') ?>" id="searchform">
			<?php echo $this->makeSearchInput(array( "id" => "searchInput", "placeholder" => "搜索" )); ?>
		</form>
		<div id="page-menu" class="menu">
			页面
			<ul>
				<?php
				foreach($this->data['content_actions'] as $key => $tab) {
					echo '
				' . $this->makeListItem( $key, $tab );
				} ?>
			</ul>
		</div>
		<div id="tool-box" class="menu">
			工具
			<ul <?php $this->html( 'userlangattributes' ) ?>>
				<?php foreach( $this->getToolbox() as $key => $val ): ?>
				<?php echo $this->makeListItem( $key, $val ); ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="user-menu" class="menu">
			用户
			<ul <?php $this->html( 'userlangattributes' ) ?>>
				<?php foreach( $this->getPersonalTools() as $key => $item ) { ?>
				<?php echo $this->makeListItem( $key, $item ); ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<!-- End of Toolbar -->
<!-- content -->
<div id="content" class="mw-body" role="main">
	<a id="top"></a>
	<?php if($this->data['sitenotice']) { ?>
	<div id="siteNotice"><?php $this->html('sitenotice') ?></div>
	<?php } ?>
	<h1 id="firstHeading" class="firstHeading" lang="<?php
		$this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getCode();
		$this->html( 'pageLanguage' );
	?>"><span dir="auto"><?php $this->html('title') ?></span></h1>
	<div id="bodyContent" class="mw-body">
		<div id="contentSub"<?php $this->html('userlangattributes') ?>><?php $this->html('subtitle') ?></div>
<?php if($this->data['undelete']) { ?>
		<div id="contentSub2"><?php $this->html('undelete') ?></div>
<?php } ?><?php if($this->data['newtalk'] ) { ?>
		<div class="usermessage"><?php $this->html('newtalk')  ?></div>
<?php } ?><?php if($this->data['showjumplinks']) { ?>
		<div id="jump-to-nav" class="mw-jump"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a><?php $this->msg( 'comma-separator' ) ?><a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div>
<?php } ?>
		<!-- start content -->
<?php $this->html('bodytext') ?>
		<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
		<!-- end content -->
		<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
		<div class="visualClear"></div>
	</div>
		<!-- /bodyContent -->
</div>
<!-- /content -->
<!-- Footer -->
<div id="footer">
	<?php
		$validFooterIcons = $this->getFooterIcons ( "icononly" );
		$validFooterLinks = $this->getFooterLinks ( "flat" );
		foreach ( $validFooterIcons as $blockName => $footerIcons ) {
			?>
	<div id="footer-icon">
	<?php foreach ( $footerIcons as $icon ) { ?>
		<?php echo $this->getSkin()->makeFooterIcon( $icon ); ?>
	<?php } ?>
	</div>
	<?php
		}
		?>
		<ul><?php
		if (count ( $validFooterLinks ) > 0) {
			foreach ( $validFooterLinks as $aLink ) {
				?><li><?php
				$this->html ( $aLink );
				?></li>
		<?php
			}
		}
		?></ul><?php
		?>
</div>
<!-- End of Footer -->
<?php $this->printTrail(); ?>
</body>
</html>
<?php
	}
} // end of class

?>

