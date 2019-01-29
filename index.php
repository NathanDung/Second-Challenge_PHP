<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>留言板</title>
		<meta name="description" content="based on widget boxes with 2 different styles" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<script src="assets/js/ace-extra.min.js"></script>
	</head>

	<?php
		//取得連線
		$conn = mysqli_connect('localhost', 'root', '', 'cv1');
		
		//查詢留言資料
		$resultQuery = "SELECT * FROM datas ORDER BY create_time DESC";
		$result = mysqli_query($conn, $resultQuery);
		
		$data_nums = mysqli_num_rows($result); //統計總比數
		
		//設定查詢筆數
		$per = 10;
		
		$pages = ceil($data_nums/$per); //取得不小於值的下一個整數
		if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
			$page=1; //則在此設定起始頁數
		} else {
			$page = intval($_GET["page"]); //確認頁數只能夠是數值資料
		}
		$start = ($page-1)*$per; //每一頁開始的資料序號
		
		$result = mysqli_query($conn, $resultQuery.' LIMIT '.$start.', '.$per) or die("Error");
		
	?>
	
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="./" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							留言板
						</small>
					</a>
				</div>

				<?php if (isset($_SESSION['username'])) { ?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--新增留言-->
						<li class="purple dropdown-modal">
							<a href="#message-modal" role="button" data-toggle="modal">	
								新增留言
							</a>
						</li>
						<li class="green dropdown-modal">
							<a href="./modify_message.php" role="button" data-toggle="modal">	
								留言管理
							</a>
						</li>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>您好,</small>
									<?=$_SESSION['username']?>
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#modify-modal" data-toggle="modal">
										<i class="ace-icon fa fa-cog"></i>
										修改密碼
									</a>
								</li>
								<li class="divider"></li>

								<li>
									<a href="./logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										登出
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<?php } else { ?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--新增留言-->
						<li class="light-blue dropdown-modal">							
							<a href="#login-modal" role="button" data-toggle="modal">
								帳號登入
							</a>
						</li>
					</ul>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--新增留言-->
						<li class="red dropdown-modal">							
							<a href="#register-modal" role="button" data-toggle="modal">
								新會員註冊
							</a>
						</li>
					</ul>
				</div>
				<?php } ?>
				
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div id="timeline-1">
									<div class="row">
										<div class="col-xs-12 col-sm-10 col-sm-offset-1">
											<div class="">
												<div class="timeline-items">
												<?php while($row = $result->fetch_assoc()) { ?>
													<div class="timeline-item clearfix">
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<a href="#" class="blue"><?= $row['username']; ?></a>
																</h5>

																<span class="widget-toolbar no-border">
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?= $row['update_time']; ?>
																</span>
															</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?= $row['message']; ?>
																	<div class="space-6"></div>																
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
												</div><!-- /.timeline-items -->
											</div><!-- /.timeline-container -->
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
				<!--分頁-->
				<div class="center">
					<span class="green middle bolder">
						<?= '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁'?>
					</span>
					<br>
					<ul class="pagination no-margin">
						<li class="prev">
							<a href="?page=1">首頁</a>
						</li>
						<?php 
							for( $i=1 ; $i<=$pages ; $i++ ) { 
								if ( $page-3 < $i && $i < $page+3 ) {
						?>
						<li class="<?=$page==$i?'active':''?>">
							<a href="?page=<?=$i?>"><?=$i?></a>
						</li>
						<?php 
								} 
							} 
						?>
						<li class="next">
							<a href="?page=<?=$pages?>">末頁</a>
						</li>
					</ul>			
				</div>
			</div>
		</div><!-- /.main-container -->							
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<?php if (isset($_SESSION['username'])) { ?>
		<div id="message-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">新增留言</h3>
					</div>
					<div class="modal-body">		
						<form id="messageForm" method="POST" action="./list.php" class="form-horizontal" role="form"> <!--登入的表格-->					
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="email">帳號 : </label>
									<div class="col-sm-7">
										<input type="text" value="<?=$_SESSION['username']?>" class="form-control" disabled/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="password_1">Message : </label>
									<div class="col-sm-7">
										<textarea rows="4" cols="50" type="text" name="message" class="form-control"></textarea>
									</div>
								</div>						
							</div>
						</form>
					<div class="modal-footer">
						<button class="btn btn-sm btn-info pull-right" data-dismiss="modal" type="button" onclick="submitForm('messageForm')">								
							送出
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<div id="modify-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">密碼修改</h3>
					</div>
					<div class="modal-body">		
						<form id="modifyForm" method="POST" action="./modify_db.php" class="form-horizontal" role="form"> <!--登入的表格-->					
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="old_password">舊密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="old_password" name="old_password" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="new_password_1">新密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="new_password_1" name="new_password_1" class="form-control" />
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="new_password_2">確認新密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="new_password_2" name="new_password_2"  class="form-control" />
									</div>
								</div>						
							</div>
						</form>
					<div class="modal-footer">
						<button class="btn btn-sm btn-info pull-right" data-dismiss="modal" type="button" onclick="submitForm('modifyForm')">
							送出
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<?php } ?>
		<?php if (!isset($_SESSION['username'])) { ?>
		<div id="login-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">帳號登入</h3>
					</div>
					<div class="modal-body">		
						<form id="loginForm" method="POST" action="./login.php" class="form-horizontal" role="form">					
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="email">帳號 : </label>
									<div class="col-sm-7">
										<input type="text" id="email" name="email" placeholder="(請輸入email)" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="password_1">密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="password_1" name="password_1"  class="form-control" />
									</div>
								</div>						
							</div>
						</form>
					<div class="modal-footer">
						<button class="btn btn-sm btn-info pull-right" data-dismiss="modal" type="button" onclick="submitForm('loginForm')">
							送出
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<div id="register-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="smaller lighter blue no-margin">新會員註冊</h3>
					</div>
					<div class="modal-body">		
						<form id="registerForm" method="POST" action="./register_db.php" class="form-horizontal" role="form"> <!--登入的表格-->					
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="username">使用者名稱 : </label>
									<div class="col-sm-7">
										<input type="text" id="username" name="username" placeholder="(不少於3字)" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="email">帳號 : </label>
									<div class="col-sm-7">
										<input type="text" id="email" name="email" placeholder="(使用email註冊)" class="form-control" />
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="password_1">密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="password_1" name="password_1"  class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="password_2">確認密碼 : </label>
									<div class="col-sm-7">
										<input type="password" id="password_2" name="password_2"  class="form-control" />
									</div>
								</div>						
							</div>
						</form>
					<div class="modal-footer">
						<!--<form method="POST" action="./register.php">					
							<button class="btn btn-sm btn-danger pull-left" type="submit" >							
								註冊帳號
							</button>
						</form>-->
						<button class="btn btn-sm btn-info pull-right" data-dismiss="modal" type="button" onclick="submitForm('registerForm')">
							送出
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<?php } ?>
		<script>
			function submitForm(formName){
				$("#"+formName).submit();
			}
		</script>
	</body>
</html>