<?php require(PROTECT);?>

<div id="minicms_sidebar">
	<div id="minicms_logo">
		<a href="/" title="Dashboard">
			<!-- We'll jus throw a forklabs logo here -->
			<img src="/assets/img/forklabs_logo.png" id="minicms_sidebar-forklabs_logo" />
		</a>
	</div>
	<div id="minicms_sidebar-logout_button">
		<a id="minicms_sidebar-logout_button-link" href="/auth/logout" title="Logout">logout</a>
	</div>

	<div class="minicms_sidebar-divider">
		<hr />
	</div>

	<div id="minicms_sidebar-navigation_wrap">
		<ul id="minicms_sidebar-navigation_list">
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/" title="Dashboard">
					Dashboard
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/apps" title="Applications" class="active">
					Apps
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/email" title="Check Email">
					E-Mail
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/settings" title="Settings">
					Settings
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-assets" class="minicms_sidebar-navi_link">
				<a href="/assets" title="Files">
					Files
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/datbases" title="Databases">
					Databases
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/info" title="Client Information">
					Client Information
				</a>
			</li>
			<li id="minicms_sidebar-navi_link-dashboard" class="minicms_sidebar-navi_link">
				<a href="/billing" title="Invoices">
					Invoices
				</a>
			</li>
		</ul>
	</div>

	<div class="minicms_sidebar-divider">
		<hr />
	</div>

	<div id="minicms_sidebar-forklabs_info">
		<div id="minicms_sidebar-forklabs_info-copyright">
			&copy;2015 ForkLabs, LLC. MiniCMS. 
		</div>
		<div id="minicms_sidebar-forklabs_info-copyright">
			Powered by MiniMVC.
		</div>
	</div>
</div>