	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Les Joies du Code</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">

				<ul class="nav navbar-nav">
					<?php
					foreach($pages as $page_url => $page_name) {
						$active = '';
						if ($page_url == $current_page) {
							$active = ' active';
						}
					?>
					<li class="<?= $active ?>"><a href="<?= $page_url ?>"><?= $page_name ?></a></li>
					<?php } ?>
				</ul>

				<form class="navbar-form navbar-right" action="search.php" method="GET">
					<div class="input-group">
						<input name="search" type="text" class="form-control" placeholder="Rechercher une JDC...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</form>

				<ul class="nav navbar-nav navbar-right">
					<?php if (userIsLogged()) { ?>
					<li><a>Bonjour <?= $_SESSION['firstname'] ?> (<?= user_getRoleLabel($_SESSION['role']) ?>) </a></li>

					<?php if (userIsAllowedAccess(USER_ROLE_WRITER)) { ?>
					<li><a href="admin/">Backoffice</a></li>
					<?php } ?>

					<li><a href="logout.php">Déconnexion</a></li>
					<?php } else { ?>
					<li class="<?= ($current_page == 'login.php' ? ' active' : '')?>"><a href="login.php">Connexion</a></li>
					<li class="<?= ($current_page == 'register.php' ? ' active' : '')?>"><a href="register.php">Inscription</a></li>
					<?php } ?>
				</ul>

			</div><!--/.nav-collapse -->
		</div>
	</nav>