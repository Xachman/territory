<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('styles.css') ?>
     <?= $this->Html->script('jquery/dist/jquery') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="<?= strtolower($this->fetch('title')) ?>-<?= strtolower($this->request->params['action']) ?>">
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a href="/">Home</a></li>
                <li class="has-dropdown">
                    <a href="/territories">Territories</a>
                    <ul class="dropdown">
                        <li><a href="/territories/territory-list">Territory List</a></li>
                        <li><a href="/territories/territory-pages">Territory Pages</a></li>
                        <li><a href="/territories/territory-list/over-90-days">Over 90</a></li>
                    </ul>
                </li>
                <li><a href="/checkouts">Checkouts</a></li>
                <li><a href="/do-not-calls">Do Not Calls</a></li>
                <li><a href="/participants">Participants</a></li>
                <li><a href="/users/edit/<?php echo $userLink['id'] ?>">Edit User</a></li>
                <li><a href="/users/logout" >Logout</a></li>
                <li><a href="/docs">Docs</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
