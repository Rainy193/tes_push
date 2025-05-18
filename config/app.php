<?php
//ini untuk fungsi select tabel
include "koneksi.php";
function select($query)
{
  global $db;

  $result = mysqli_query($db, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Peliharaan START ===================
// =========================================================================

// -----------------------------------------------------------------------
// ---------------------- FUNGSI TAMBAH Peliharaan START ----------------------
// ----------------------------------------------------------------------- 
function create_peliharaan($post)
{
  global $db;
  $ownerid = strip_tags($post['id_owner']);
  $nama = strip_tags($post['nama_hewan']);
  $jenis = strip_tags($post['jenis']);
  $ras = strip_tags($post['ras']);
  $jk = strip_tags($post['jenis_kelamin']);
  $tanggal = strip_tags($post['tanggal_lahir']);

  //query tambah data siswa
  $query = "INSERT into pets
    VALUES(null, '$ownerid','$nama', '$jenis', '$ras', '$jk', '$tanggal')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// -----------------------------------------------------------------------
// ----------------------- FUNGSI TAMBAH Peliharaan END -----------------------
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// ----------------------- FUNGSI EDIT Peliharaan START ---------------------
// -----------------------------------------------------------------------
function update_peliharaan($post)
{
  global $db;
  $id = $post['id'];
  $ownerid = strip_tags($post['id_owner']);
  $nama = strip_tags($post['nama_hewan']);
  $jenis = strip_tags($post['jenis']);
  $ras = strip_tags($post['ras']);
  $jk = strip_tags($post['jenis_kelamin']);
  $tanggal = strip_tags($post['tanggal_lahir']);

  //query edit data
  $query = "UPDATE pets SET id='$id', id_owner='$ownerid', nama_hewan='$nama', jenis='$jenis', ras='$ras', jenis_kelamin='$jk', tanggal_lahir='$tanggal' WHERE id=$id";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// -----------------------------------------------------------------------
// ------------------------ FUNGSI EDIT Peliharaan END ----------------------
// -----------------------------------------------------------------------

// ----------------------------------------------------------------------
// ---------------------- FUNGSI HAPUS PELIHARAAN START --------------------
// ----------------------------------------------------------------------
function delete_peliharaan($id)
{
  global $db;

  //query delete data
  $query = "DELETE FROM pets WHERE id = '$id' ";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------
// ----------------------- FUNGSI HAPUS PELIHARAAN END ---------------------
// ----------------------------------------------------------------------

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS PELIHARAAN END ===================
// =========================================================================


// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Dokter START ===================
// =========================================================================

// -----------------------------------------------------------------------
// ---------------------- FUNGSI TAMBAH Dokter START ----------------------
// ----------------------------------------------------------------------- 
function create_dokter($user)
{
    global $db;

    // Ambil data dari form
    $username = $user['username'];
    $password = $user['password']; // Sudah di-hash sebelumnya
    $nama = $user['nama'];
    $spesialisasi = $user['spesialisasi'];
    $kontek = $user['kontek'];  // Kolom 'kontek'
    $alamat = $user['alamat'];

    // Mulai transaksi
    $db->begin_transaction();

    try {
        // Menambahkan data ke tabel users
        $query_users = "INSERT INTO users (username, password, nama, role, status) 
                        VALUES ('$username', '$password', '$nama', 'dokter', 1)";
        if (!$db->query($query_users)) {
            throw new Exception("Error saat menambahkan ke tabel users: " . $db->error);
        }

        // Ambil ID user yang baru saja ditambahkan
        $id_user = $db->insert_id;

        // Menambahkan data ke tabel vets (dokter)
        $query_vets = "INSERT INTO vets (id_user, nama, spesialisasi, kontek  , alamat) 
                       VALUES ('$id_user', '$nama', '$spesialisasi', '$kontek', '$alamat')";
        if (!$db->query($query_vets)) {
            throw new Exception("Error saat menambahkan ke tabel vets: " . $db->error);
        }

        // Commit transaksi
        $db->commit();
        return true;
    } catch (Exception $e) {
        // Rollback jika terjadi error
        $db->rollback();
        echo "Error: " . $e->getMessage() . "<br>";
        return false;
    }
}





// -----------------------------------------------------------------------
// ----------------------- FUNGSI TAMBAH Dokter END -----------------------
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// ----------------------- FUNGSI EDIT Dokter START ---------------------
// -----------------------------------------------------------------------
// Fungsi untuk memperbarui data dokter
function update_dokter($post)
{
    global $db;
    $id = $post['id'];
    $nama = $post['nama'];
    $spesialisasi = $post['spesialisasi'];
    $kontek = $post['kontek'];
    $alamat = $post['alamat'];

     //query edit data
  $query = "UPDATE vets SET id='$id', nama='$nama', spesialisasi='$spesialisasi', kontek='$kontek', alamat='$alamat' WHERE id=$id";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// -----------------------------------------------------------------------
// ------------------------ FUNGSI EDIT Dokter END ----------------------
// -----------------------------------------------------------------------

// ----------------------------------------------------------------------
// ---------------------- FUNGSI HAPUS Dokter START --------------------
// ----------------------------------------------------------------------
function delete_dokter($id)
{
  global $db;

  //query delete data
  $query = "DELETE FROM vets WHERE id = '$id' ";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------
// ----------------------- FUNGSI HAPUS Dokter END ---------------------
// ----------------------------------------------------------------------

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Dokter END ===================
// =========================================================================


// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Catatan START ===================
// =========================================================================

// -----------------------------------------------------------------------
// ---------------------- FUNGSI TAMBAH Catatan START ----------------------
// ----------------------------------------------------------------------- 
function create_record($post)
{
  global $db;
  $pet = strip_tags($post['id_pet']);
  $nama = strip_tags($post['nama_dokter']);
  $tanggal = strip_tags($post['tanggal_periksa']);
  $catatan = strip_tags($post['catatan']);
  $vaksin = strip_tags($post['vaksinasi']);
  $nama_vaksin = strip_tags($post['nama_vaksin']);

  //query tambah data siswa
  $query = "INSERT into health_records
    VALUES(null, '$pet','$nama', '$tanggal', '$catatan', '$vaksin', '$nama_vaksin')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// -----------------------------------------------------------------------
// ----------------------- FUNGSI TAMBAH Catatan END -----------------------
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// ----------------------- FUNGSI EDIT Catatan START ---------------------
// -----------------------------------------------------------------------
function update_record($post)
{
  global $db;
  $id_record = $post['id'];
  $id_pet = $post['id_pet'];
  $id_dokter = $post['id_dokter'];
  $tanggal_periksa = $post['tanggal_periksa'];
  $catatan = $post['catatan'];
  $vaksinasi = $post['vaksinasi'];
  $nama_vaksin = $post['nama_vaksin'];

  // Query update data ke tabel health_records
  $query = "UPDATE health_records 
            SET 
                id_pet = '$id_pet', 
                id_dokter = '$id_dokter',
                tanggal_periksa = '$tanggal_periksa', 
                catatan = '$catatan', 
                vaksinasi = '$vaksinasi', 
                nama_vaksin = '$nama_vaksin'
            WHERE id = '$id_record'";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}


// -----------------------------------------------------------------------
// ------------------------ FUNGSI EDIT Catatan END ----------------------
// -----------------------------------------------------------------------

// ----------------------------------------------------------------------
// ---------------------- FUNGSI HAPUS Catatan START --------------------
// ----------------------------------------------------------------------
function delete_record($id)
{
  global $db;

  //query delete data
  $query = "DELETE FROM health_records WHERE id = '$id' ";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------
// ----------------------- FUNGSI HAPUS Catatan END ---------------------
// ----------------------------------------------------------------------

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Catatan END ===================
// =========================================================================


// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Dokter END ===================
// =========================================================================


// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Pemilik START ===================
// =========================================================================

// -----------------------------------------------------------------------
// ---------------------- FUNGSI TAMBAH Pemilik START ----------------------
// ----------------------------------------------------------------------- 
function create_owner($post)
{
    global $db;

    // Data dari form
    $username = $post['username'];
    $password = password_hash($post['password'], PASSWORD_DEFAULT);
    $nama = $post['nama'];
    $email = $post['email'];
    $kontak = $post['kontak'];
    $alamat = $post['alamat'];

    // Mulai transaksi
    $db->begin_transaction();

    try {
        // Tambahkan data ke tabel users
        echo "Menambahkan data ke tabel users...<br>";
        $query_users = "INSERT INTO users (username, password, nama, role, status) 
                        VALUES (?, ?, ?, 'owner', 1)";
        $stmt_users = $db->prepare($query_users);
        if (!$stmt_users) {
            throw new Exception("Prepare query_users failed: " . $db->error);
        }
        $stmt_users->bind_param('sss', $username, $password, $nama);
        if (!$stmt_users->execute()) {
            throw new Exception("Execute query_users failed: " . $stmt_users->error);
        }

        // Dapatkan ID user yang baru saja ditambahkan
        $id_user = $db->insert_id;
        echo "ID user yang ditambahkan: $id_user<br>";

        // Tambahkan data ke tabel owners
        echo "Menambahkan data ke tabel owners...<br>";
        $query_owners = "INSERT INTO owners (id_user, nama, email, kontak, alamat) 
                         VALUES (?, ?, ?, ?, ?)";
        $stmt_owners = $db->prepare($query_owners);
        if (!$stmt_owners) {
            throw new Exception("Prepare query_owners failed: " . $db->error);
        }
        $stmt_owners->bind_param('issss', $id_user, $nama, $email, $kontak, $alamat);
        if (!$stmt_owners->execute()) {
            throw new Exception("Execute query_owners failed: " . $stmt_owners->error);
        }

        // Commit transaksi
        echo "Melakukan commit...<br>";
        $db->commit();
        return true;
    } catch (Exception $e) {
        // Rollback jika terjadi error
        echo "Terjadi error: " . $e->getMessage() . "<br>";
        $db->rollback();
        return false;
    }
}

// -----------------------------------------------------------------------
// ----------------------- FUNGSI TAMBAH Pemilik END -----------------------
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// ----------------------- FUNGSI EDIT Pemilik START ---------------------
// -----------------------------------------------------------------------
function update_owner($post)
{
    global $db; // Gunakan variabel koneksi global

    // Ambil data dari form
    $id_owner = $post['id'];
    $nama = $post['nama'];
    $alamat = $post['alamat'];
    $kontak = $post['kontak'];
    $email = $post['email'];

    // Query untuk memperbarui data di tabel owners
    $query = "UPDATE owners 
              SET nama = '$nama', alamat = '$alamat', kontak = '$kontak', email = '$email' 
              WHERE id = '$id_owner'";

    // Eksekusi query
    $result = $db->query($query);

    // Return hasil operasi (jumlah baris yang terpengaruh)
    return mysqli_affected_rows($db);
}

// -----------------------------------------------------------------------
// ------------------------ FUNGSI EDIT Pemilik END ----------------------
// -----------------------------------------------------------------------

// ----------------------------------------------------------------------
// ---------------------- FUNGSI HAPUS Pemilik START --------------------
// ----------------------------------------------------------------------
function delete_owner($id)
{
  global $db;

  //query delete data
  $query = "DELETE FROM owners WHERE id = '$id' ";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------
// ----------------------- FUNGSI HAPUS Pemilik END ---------------------
// ----------------------------------------------------------------------

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Pemilik END ===================
// =========================================================================








// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Pemilik START ===================
// =========================================================================

// -----------------------------------------------------------------------
// ---------------------- FUNGSI TAMBAH Pemilik START ----------------------
// ----------------------------------------------------------------------- 
function create_pengguna($post)
{
  global $db;
  $username = strip_tags($post['username']);
  $password = strip_tags($post['password']);
  $nama = strip_tags($post['nama']);
  $level = strip_tags($post['level']);
  $status = strip_tags($post['status']);

  //query tambah data pengguna
  $query = "INSERT into pengguna
    VALUES(null, '$username','$password', '$nama', '$level', '$status')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// -----------------------------------------------------------------------
// ----------------------- FUNGSI TAMBAH Pemilik END -----------------------
// -----------------------------------------------------------------------

// -----------------------------------------------------------------------
// ----------------------- FUNGSI EDIT Pemilik START ---------------------
// -----------------------------------------------------------------------
function update_pengguna($post)
{
  global $db;
  $id = $post['id'];
  $username = strip_tags($post['username']);
  $password = strip_tags($post['password']);
  $nama = strip_tags($post['nama']);
  $level = strip_tags($post['role']);
  $status = strip_tags($post['status']);

  //query edit data
  $query = "UPDATE users SET id='$id', username='$username', password='$password', nama='$nama', role='$level', status='$status' WHERE id=$id";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// -----------------------------------------------------------------------
// ------------------------ FUNGSI EDIT Pemilik END ----------------------
// -----------------------------------------------------------------------

// ----------------------------------------------------------------------
// ---------------------- FUNGSI HAPUS Pemilik START --------------------
// ----------------------------------------------------------------------
function delete_pengguna($id)
{
  global $db;

  //query delete data
  $query = "DELETE FROM users WHERE id='$id'";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------
// ----------------------- FUNGSI HAPUS Pemilik END ---------------------
// ----------------------------------------------------------------------

// =========================================================================
// =================== TAMBAH - EDIT - HAPUS Pemilik END ===================
// =========================================================================