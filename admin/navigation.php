<?php
if ($_SESSION['leveluser']=='admin'){
echo"<li>
          <a href='media.php?module=home'>
            <i class='fa fa-th'></i> <span>Home</span>
            
          </a>
        </li>            
        <li class='treeview'>
          <a href='#'>
            <i class='fa fa-users'></i> <span>Master User</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
			<li><a href='media.php?module=admin'><i class='fa fa-circle-o'></i> Admin</a></li>
            <li><a href='media.php?module=karyawan'><i class='fa fa-circle-o'></i> Karyawan</a></li>
          </ul>
        </li> 
		<li class='treeview'>
          <a href='#'>
            <i class='fa fa-folder'></i> <span>Master Data</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
            <li><a href='media.php?module=merk'><i class='fa fa-circle-o'></i> Merk</a></li>
			<li><a href='media.php?module=produk'><i class='fa fa-circle-o'></i> Produk</a></li>
            <li><a href='media.php?module=sparepart'><i class='fa fa-circle-o'></i> Sparepart</a></li>
            <li><a href='media.php?module=member'><i class='fa fa-circle-o'></i> Member</a></li>
          </ul>
        </li>
		<li class='treeview'>
          <a href='#'>
            <i class='fa fa-laptop'></i> <span>Manajemen Transaksi</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
		    <li><a href='media.php?module=servis'><i class='fa fa-circle-o'></i> Data Servis</a></li>
            <li><a href='media.php?module=order'><i class='fa fa-circle-o'></i> Data Orders</a></li>
          </ul>
        </li>
		<li>
          <a href='media.php?module=laporan'>
            <i class='fa fa-book'></i> <span>Laporan</span>
          </a>
		</li>
		<li class='treeview'>
          <a href='#'>
            <i class='fa fa-support'></i> <span>Support</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
		    <li><a href='media.php?module=logo'><i class='fa fa-circle-o'></i> Logo</a></li>
          </ul>
        </li>
        ";
}
else {
echo"<li>
          <a href='media.php?module=home'>
            <i class='fa fa-th'></i> <span>Home</span>
            
          </a>
        </li>
		
		<li>
          <a href='media.php?module=karyawan'>
            <i class='fa fa-users'></i> <span>Profil</span>
            
          </a>
        </li>
		<li class='treeview'>
          <a href='#'>
            <i class='fa fa-folder'></i> <span>Master Data</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
			<li><a href='media.php?module=produk'><i class='fa fa-circle-o'></i> Produk</a></li>
            <li><a href='media.php?module=sparepart'><i class='fa fa-circle-o'></i> Sparepart</a></li>
            <li><a href='media.php?module=member'><i class='fa fa-circle-o'></i> Member</a></li>
          </ul>
        </li>
		<li class='treeview'>
          <a href='#'>
            <i class='fa fa-laptop'></i> <span>Manajemen Transaksi</span> <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
		    <li><a href='media.php?module=servis'><i class='fa fa-circle-o'></i> Data Servis</a></li>
            <li><a href='media.php?module=order'><i class='fa fa-circle-o'></i> Data Orders</a></li>
          </ul>
        </li>
        ";
}
?>