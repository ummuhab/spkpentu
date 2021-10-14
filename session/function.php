<?php
$conn = mysqli_connect("localhost", "root", "", "db_audit_keu");

function query($query)
{
    global $conn;
    $tampil = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($tampil)) {
        $rows[] = $row;
    }
    return $rows;
}


function login($data)
{
	
	global $conn;
	$username = $_POST['username'];
	$password = $_POST['password'];
	// $level = $_POST['level'];
	// $status = $_POST['status'];

	// $login = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username' AND password = '$password' AND level = '$level' AND status = 1  ");

	$gagal = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username' AND password = '$password' AND status = 0  ");


		$sql = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			if($row['level']=='1'){
				session_start();
			  $_SESSION['username'] = $username;
			  $_SESSION['level'] = "1";
			  header("Location: ../direktur/index.php");
			}else if($row['level']=='2'){
				session_start();
			  $_SESSION['username'] = $username;
			  $_SESSION['level'] = "2";
			  header("Location: ../auditee/dashboard/index.php");
			}else if($row['level']=='3'){
				session_start();
			  $_SESSION['username'] = $username;
			  $_SESSION['level'] = "3";
			  header("Location: ../auditor/dashboard/index.php");
			}else if($row['level']=='4'){
				session_start();
			  $_SESSION['username'] = $username;
			  $_SESSION['level'] = "4";
			  header("Location:../kepala_spi/dashboard/index.php");
			}     
		}else {
			echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
		}

	// if (mysqli_fetch_array($login)) {
 

	// 	$re1 = mysqli_query($conn, "SELECT username FROM tb_user WHERE $level=1 ");
	// 	$re2 = mysqli_query($conn, "SELECT username FROM tb_user WHERE $level=2 ");
	// 	$re3 = mysqli_query($conn, "SELECT username FROM tb_user WHERE $level=3 ");
	// 	$re4 = mysqli_query($conn, "SELECT username FROM tb_user WHERE $level=4 ");

	// 	if (mysqli_fetch_assoc($re1)) {

	// 		session_start();
	// 		$_SESSION['username'] = $username;
	// 		header('location:../direktur/index.php');
	// 	}


	// 	if (mysqli_fetch_assoc($re2)) {
	// 		session_start();
	// 		$_SESSION['username'] = $username;
	// 		header('location:../auditee/profile/index.php');
	// 	}

	// 	if (mysqli_fetch_assoc($re3)) {
	// 		session_start();
	// 		$_SESSION['username'] = $username;
	// 		header('location:../auditor/profile/index.php');
	// 	}

	// 	if (mysqli_fetch_assoc($re4)) {
	// 		session_start();
	// 		$_SESSION['username'] = $username;
	// 		header('location:../kepala_spi/profile/index.php');
	// 	}
	// }

	if (mysqli_fetch_array($gagal)) {
		echo "<script>
		alert('akun belum terkonfirmasi');
		document.location.href='index.php';
		</script>";
	} else {
		echo "<script>
		alert('user gagal login');
		document.location.href='index.php';
		</script>";
	}
	
	return mysqli_affected_rows($conn);
}

// function login($data)
// {
//     global $conn;
//     $username = strtolower(htmlspecialchars($data["username"]));
//     $password = md5($data["password"]);

    
//     $q3 = mysqli_query($conn,"SELECT * FROM,  tb_auditor  WHERE username='$username' AND password='$password'");
//     $r3 = mysqli_num_rows($q3);
//     $s3 = mysqli_fetch_assoc($q3);

//     $q2 = mysqli_query($conn,"SELECT * FROM,  tb_auditor  WHERE username='$username' AND password='$password'");
//     $r2 = mysqli_num_rows($q2);
//     $s2 = mysqli_fetch_assoc($q2);

//     $q1 = mysqli_query($conn,"SELECT * FROM, tb_auditee WHERE username='$username' AND password='$password'");
//     $r1 = mysqli_num_rows($q1);
//     $s1 = mysqli_fetch_assoc($q1);  

//     $q0 = mysqli_query($conn,"SELECT * FROM, tb_auditee WHERE username='$username' AND password='$password'");
//     $r0 = mysqli_num_rows($q0);
//     $s0 = mysqli_fetch_assoc($q0);

//     if ($s3 == 1) {
//         session_start();
// 		$_SESSION['username'] = $username;
//         $_SESSION['user_id'] = $s3['id_auditor'];
//         $_SESSION['username'] = $s3['username'];
//         $_SESSION['password'] = $s3['password'];
//         $_SESSION['status'] = 'Aktif';
//         $_SESSION['jabatan']= 'Ketua';
//         header('location:../kepala_spi/index.php');
//     }
//     elseif ($s2 == 1) {
//         session_start();
// 		$_SESSION['username'] = $username;
//         $_SESSION['user_id'] = $s2['id_auditor'];
//         $_SESSION['username'] = $s2['username'];
//         $_SESSION['password'] = $s2['password'];
//         $_SESSION['status'] = 'Aktif';
//         header('location:../auditor/index.php');
//     }
//     elseif ($s1 == 1) {
//         session_start();
// 		$_SESSION['username'] = $username;
//         $_SESSION['user_id'] = $s1['id'];
//         $_SESSION['username'] = $s1['username'];
//         $_SESSION['password'] = $s1['password'];
//         $_SESSION['status'] = 'Aktif';
//         header('location:../auditee/index.php');
//     }
//     elseif ($s0 == 1) {
//         session_start();
// 		$_SESSION['username'] = $username;
//         $_SESSION['user_id'] = $s0['id_auditor'];
//         $_SESSION['username'] = $s0['username'];
//         $_SESSION['password'] = $s0['password'];
//         $_SESSION['status'] = 'Aktif';
//         $_SESSION['unit']= $s0['DIREKTUR'];
//         header('location:../direktur/index.php');
//     } else {
//         echo "<script>
// 		alert('user gagal login');
// 		document.location.href='index.php';
// 		</script>";
//     }

//     return mysqli_affected_rows($conn);
// }


?>