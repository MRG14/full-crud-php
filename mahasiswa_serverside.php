<?php
include 'config/database.php';
 
if ($_GET['action'] == "table_data") {
 
    $columns = array(
        0 => 'id_mahasiswa',
        1 => 'nama_mahasiswa',
        2 => 'prodi_mahasiswa',
        3 => 'jk_mahasiswa',
        4 => 'noor_telepon',
        5 => 'id_mahasiswa'
    );
 
    $querycount = $db->query("SELECT count(id_mahasiswa) as jumlah FROM mahasiswa");
    $datacount = $querycount->fetch_array();
 
    $totalData = $datacount['jumlah'];
 
    $totalFiltered = $totalData;
 
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
 
    if (empty($_POST['search']['value'])) {
        $query = $db->query("SELECT id_mahasiswa,nama_mahasiswa,prodi_mahasiswa,jk_mahasiswa,nomor_telepon FROM mahasiswa ORDER BY $order $dir LIMIT $limit OFFSET $start");
 
    } else {
        $search = $_POST['search']['value'];
        $query = $db->query("SELECT id_mahasiswa,nama_mahasiswa,prodi_mahasiswa,jk_mahasiswa,nomor_telepon FROM mahasiswa WHERE nama LIKE '%$search%' OR telepon LIKE '%$search%' ORDER BY $order $dir LIMIT $limit OFFSET $start");
 
        $querycount = $db->query("SELECT count(id_mahasiswa) as jumlah FROM mahasiswa WHERE nama_mahasiswa LIKE '%$search%' OR nomor_telepon LIKE '%$search%'");
 
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }
 
    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($value = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['nama_mahasiswa'] = $value['nama_mahasiswa'];
            $nestedData['prodi_mahasiswa'] = $value['prodi_mahasiswa'];
            $nestedData['jk_mahasiswa'] = $value['jk_mahasiswa'];
            $nestedData['nomor_telepon'] = $value['nomor_telepon'];
            $nestedData['aksi'] = '<div width="25%" class="text-center">
            <a href="form_detail_mahasiswa.php?id_mahasiswa='.$value['id_mahasiswa'].'" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
            <a href="form_update_mahasiswa.php?id_mahasiswa='.$value['id_mahasiswa'].'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
            <a href="form_delete_mahasiswa.php?id_mahasiswa='.$value['id_mahasiswa'].'" class="btn btn-danger btn-sm" onclick="return confirm("Yakin data barang akan dihapus?")"><i class="fas fa-trash"></i> Hapus</a>
            </div>';
            $data[] = $nestedData;
            $no++;
        }
    }
 
    $json_data = [
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    ];
 
    echo json_encode($json_data);
}
?>