<?php
require_once 'partials/header.php';

// Counts
$query = $db->query('SELECT COUNT(id) as count_total FROM articles');
$result = $query->fetch();
$count_articles = $result['count_total'];

$query = $db->query('SELECT COUNT(id) as count_total FROM users');
$result = $query->fetch();
$count_users = $result['count_total'];

$count_comments = 0;
$count_messages = 0;

// Derniers articles JDC
$query = $db->query('SELECT * FROM articles ORDER BY creation_date DESC LIMIT 5');
$last_articles = $query->fetchAll();

// Derniers utilisateurs inscrits
$query = $db->query('SELECT * FROM users ORDER BY cdate DESC LIMIT 5');
$last_users = $query->fetchAll();
//echo debug($last_users);
?>

				<h1 class="page-header">Tableau de bord</h1>

				<div class="row placeholders">
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/sky/text:<?= $count_articles ?> \n JDC" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de JDC</h4>
						<span class="text-muted"><?= $count_articles ?></span>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/vine/text:<?= $count_users ?> \n inscriptions" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre d'inscriptions</h4>
						<span class="text-muted"><?= $count_users ?></span>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/social/text:<?= $count_comments ?> \n commentaires" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de commentaires</h4>
						<span class="text-muted"><?= $count_comments ?></span>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/#5bc0de:#fff/text:<?= $count_messages ?> \n messages" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de messages</h4>
						<span class="text-muted"><?= $count_messages ?></span>
					</div>
				</div>

				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Dernières JDC</h3>
					</div>
					<div class="list-group">
						<?php foreach($last_articles as $article) { ?>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading"><?= ucfirst($article['name']) ?> (<?= getFormatDate($article['creation_date']) ?>)</h4>
							<p class="list-group-item-text"><?= cutString($article['content'], 100, ' [...]') ?></p>
						</a>
						<?php } ?>
					</div>
				</div>

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Dernières inscriptions</h3>
					</div>
					<div class="list-group">

						<?php foreach($last_users as $user) { ?>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading"><?= user_getFullName($user) ?> (<?= user_getGenderLabel($user['gender']) ?>)</h4>
							<p class="list-group-item-text">Inscrit le <?= getFormatDate($user['cdate'], 'd/m/Y \à H\hi') ?></p>
						</a>
						<?php } ?>

					</div>
				</div>

<?php require_once 'partials/footer.php' ?>