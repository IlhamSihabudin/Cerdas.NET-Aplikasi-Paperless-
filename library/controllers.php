<?php 
	/**
	* 
	*/
	class oop
	{
		
		function login($con, $table, $user, $pass, $session)
		{
			$query = mysqli_query($con, "SELECT * FROM $table WHERE username = '$user' and password = '$pass'");
			$tampil = mysqli_fetch_array($query);
			$cek = mysqli_num_rows($query);
			if ($cek > 0) {
				@session_start();
				if ($session == "guru") {
					if ($tampil['status'] == "aktif") {
						$_SESSION['username'] = $tampil['username'];
						$_SESSION['level'] = $session;
						echo "<script>alert('Selamat Datang!!');document.location.href='$session'</script>";
					}else{
						echo "<script>alert('Akun Anda di Nonaktifkan !!');document.location.href='index.php?menu=login_guru'</script>";
					}
				}else{
					$_SESSION['username'] = $tampil['username'];
					$_SESSION['level'] = $session;
					echo "<script>alert('Selamat Datang!!');document.location.href='$session'</script>";
				}
			} else {
				echo "<script>alert('Username Atau Password Salah !!');document.location.href='index.php'</script>";
			}
		}

		function selectAll($con, $table)
		{
			$query = mysqli_query($con, "SELECT * FROM $table");
			while ($data = mysqli_fetch_array($query)) {
				$isi[] = $data;
			}
			return @$isi;
		}

		function selectAllOrder($con, $table, $order, $format)
		{
			$query = mysqli_query($con, "SELECT * FROM $table ORDER BY $order $format");
			while ($data = mysqli_fetch_array($query)) {
				$isi[] = $data;
			}
			return @$isi;
		}

		function selectCount($con, $table, $where)
		{
			$query = mysqli_query($con, "SELECT * FROM $table WHERE $where");
			$data = mysqli_num_rows($query);
			return @$data;
		}

		function selectWhere($con, $table, $where)
		{
			$query = mysqli_query($con, "SELECT * FROM $table WHERE $where");
			$data = mysqli_fetch_array($query);
			return @$data;
		}

		function insert($con, $table, $isi, $link)
		{
			$query = mysqli_query($con, "INSERT INTO $table SET $isi");
			if ($query) {
				echo "<script>alert('Data Berhasil Ditambahkan..');document.location.href='$link'</script>";
			}else{
				echo "<script>alert('Terjadi Kesalahan!!');</script>";
			}				
		}

		function insertSelect($con, $table, $isi, $where, $link)
		{
			$query = mysqli_query($con, "SELECT * FROM $table WHERE $where");
			$cek = mysqli_num_rows($query);
			if($cek > 0){
				echo "<script>alert('Data Sudah Ada!!');document.location.href='$link'</script>";
			}else{
				$query = mysqli_query($con, "INSERT INTO $table SET $isi");

				if ($query) {
					echo "<script>alert('Data Berhasil Ditambahkan..');document.location.href='$link'</script>";
				}else{
					echo "<script>alert('Terjadi Kesalahan!!');</script>";
				}
			}
		}

		function update($con, $table, $isi, $where, $link)
		{
			$query = mysqli_query($con, "UPDATE $table SET $isi WHERE $where");
			if ($query) {
				echo "<script>alert('Data Berhasil Di Update');document.location.href='$link'</script>";
			}else{
				echo "<script>alert('Terjadi Kesalahan!!')</script>";
			}
		}

		function delete($con, $table, $where, $link)
		{
			$query = mysqli_query($con, "DELETE FROM $table WHERE $where");
			if ($query) {
				echo "<script>alert('Data Berhasil Dihapus');document.location.href='$link'</script>";
			}else{
				echo "<script>alert('Terjadi Kesalahan!!')</script>";
			}
		}
	}
 ?>