<?php //phpinfo(); die(); ?>

<script>
    function upload () {

        var el  = document.getElementById('aaaaaaaaaaaaaaaaaaaaaaaa');
        var fd = new FormData();
        fd.append('file', el.files[0]);
        fd.append('action', 'upload_file');


        var xhr = new XMLHttpRequest();
        xhr.open('POST', gic.ajaxurl, true);

        var size = el.files[0].size;
        var c = document.getElementById('ccc');
        var b = document.getElementById('bbb');

        xhr.upload.onprogress = function(event) {
            var p = event.loaded / event.total;
            console.log(' p= '+ p);
            if (p < 0.95) {
                console.log(' w= ' + b.clientWidth * p);
                c.style.width = b.clientWidth * p + 'px';
            }
        };

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = JSON.parse(xhr.responseText);
                if (res.error || !res.success) {
                    c.style.width = 0 + 'px';
                    throw new Error(res.error);
                }
                c.style.width = b.clientWidth + 'px';
                console.log(res.success);
            }
        };
        xhr.send(fd);
    }

    function save () {

        var fd = new FormData();
        fd.append('action', 'save_session_files');


        var xhr = new XMLHttpRequest();
        xhr.open('POST', gic.ajaxurl, true);


        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = JSON.parse(xhr.responseText);
                if (res.error) {
                    throw new Error(res.error);
                }
                console.log(res.success);
            }
        };
        xhr.send(fd);
    }

</script>

<input type="file" id="aaaaaaaaaaaaaaaaaaaaaaaa">
<button onclick="upload()">Send file</button>
<button onclick="save()">Save loaded files</button>
<div id="bbb" style="height:30px;background-color:#0A246A">
    <div id="ccc" style="height:100%;width:0;background-color:#00FFD4;transition:width 3s;"></div>
</div>

<div class="top-bar" id="top">
	<ul class="nav justify-content-center flex-nowrap" id='desktop-top-bar'>
		<li class="nav-item nav-link tb-menu-item">
			<div class="tb-menu-border"></div>
		</li>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
                    <i class="fa fa-phone tb-menu-logo"></i>
					<a class="top-bar-menu-link white-link-underline" href="tel:+16475584910">+16475584910</a>
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
                    <i class="fa fa-skype tb-menu-logo skype-logo"></i>
					<a class="col top-bar-menu-link white-link-underline to-hide" href="skype:#?call">Skype</a>
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
					<div class="col col-md-auto tb-menu-logo messager-logo"></div>
					<a class="col top-bar-menu-link white-link-underline to-hide" href="#">Напишите нам</a>
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
					<div class="col-auto tb-menu-logo search-logo"></div>
					<input type="text" class="col tb-search" placeholder="Поиск">
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item ">
			<div class="container-fluid" id="tb-socials">
				<div class="row align-items-center flex-nowrap">
                    <a href="#" class="col-auto"><i class="fa fa-vk tb-menu-logo"></i></a>
                    <a href="#" class="col-auto"><i class="fa fa fa-facebook tb-menu-logo"></i></a>
                    <a href="#" class="col-auto"><i class="fa fa-instagram tb-menu-logo"></i></a>
                    <div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link dropdown tb-menu-item">
			<a class="nav-link dropdown-toggle top-bar-menu-link white-link-none" data-toggle="dropdown"
			   href="#"
			   role="button"
			   aria-haspopup="true" aria-expanded="false">Русский</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#">Английский</a>
				<a class="dropdown-item" href="#">Украинский</a>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item to-hide">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
	</ul>
	<ul class="nav justify-content-between flex-nowrap" id='mobile-top-bar'>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
                    <i class="fa fa-phone tb-menu-logo"></i>
                    <a class="top-bar-menu-link white-link-underline" href="tel:+16475584910">+16475584910</a>
					<div class="tb-menu-border"></div>
				</div>
			</div>
		</li>
		<li class="nav-item nav-link tb-menu-item">
			<div class="container-fluid">
				<div class="row align-items-center flex-nowrap">
                    <div class="col tb-menu-logo messager-logo"></div>
                    <div class="col-auto tb-menu-border"></div>
                    <i class="col fa fa-skype tb-menu-logo"></i>
                    <div class="col-auto tb-menu-border"></div>
                    <div class="col tb-menu-logo search-logo"></div>
                    <input type="text" class="col tb-search to-hide" placeholder="Поиск">
				</div>
			</div>
		</li>
	</ul>
</div> <!--top-bar-->
