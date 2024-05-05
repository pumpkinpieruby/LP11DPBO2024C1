<?php
include_once("kontrakView.php");
include_once("presenter/ProsesPasien.php");

class createView implements kontrakView 
{
    private $prosespasien; // presenter yang dapat berinteraksi langsung dengan view
    
    function __construct()
    {
        // konstruktor
        $this->prosespasien = new ProsesPasien();
    }
    
    function tampil()
    {
        $data = null;
        $data .= '<form method="post" action="create.php">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-dark text-center">Tambah Pasien</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" id="nik" name="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat Lahir:</label>
                            <input type="text" id="tempat" name="tempat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tl">Tanggal Lahir:</label>
                            <input type="date" id="tl" name="tl" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin:</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Nomor Telepon:</label>
                            <input type="tel" id="telephone" name="telephone" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pasien</button>
                    </div>
                </div>
            </div>
        </form>';

        return $data;
    }

    function tampilUpdate()
    {
        // Mendapatkan ID Pasien dari URL
        $id = $_GET['id'];
        
        // Mendapatkan data pasien berdasarkan ID
        $pasien = $this->prosespasien->getPasienByID($id);
        
        if ($pasien) {
            // Jika data pasien ditemukan, tampilkan form update
            $data = null;
            $data .= '<form method="post" action="create.php">
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-dark text-center">Update Pasien</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="' . $pasien['id'] . '" >
                                <label for="nik">NIK:</label>
                                <input type="text" id="nik" name="nik" class="form-control" value="' . $pasien['nik'] . '" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="' . $pasien['nama'] . '" required>
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat Lahir:</label>
                                <input type="text" id="tempat" name="tempat" class="form-control" value="' . $pasien['tempat'] . '" required>
                            </div>
                            <div class="form-group">
                                <label for="tl">Tanggal Lahir:</label>
                                <input type="date" id="tl" name="tl" class="form-control" value="' . $pasien['tl'] . '" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin:</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="L" ' . ($pasien['gender'] == 'L' ? 'selected' : '') . '>Laki-laki</option>
                                    <option value="P" ' . ($pasien['gender'] == 'P' ? 'selected' : '') . '>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" value="' . $pasien['email'] . '">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Nomor Telepon:</label>
                                <input type="tel" id="telephone" name="telephone" class="form-control" value="' . $pasien['telephone'] . '">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Pasien</button>
                        </div>
                    </div>
                </div>
            </form>';

            return $data;
        } else {
            // Jika data pasien tidak ditemukan, tampilkan pesan error
            return "Data pasien tidak ditemukan.";
        }
    }

    function add($data)
    {
        $this->prosespasien->add($data);
         // Redirect to index.php after adding data
        echo '<script>window.location.href = "index.php";</script>';
    }

    function update($data)
    {
        $this->prosespasien->update($data);
    }
}
?>
