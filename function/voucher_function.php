<?php 
    function daftarVoucher($connect){
        $sql = "SELECT * FROM vouchers";
        $result = $connect->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function tukarVoucher($connect, $id_user, $id_voucher){
        //ambil data voucher
        $sql = "SELECT * FROM vouchers WHERE id_voucher = '$id_voucher'";
        $result = $connect->query($sql);
        $voucher = $result->fetch_assoc();

        //ambil poi user
        $sql = "SELECT poin FROM users WHERE id_user = '$id_user'";
        $resultUser = $connect->query($sql);
        $user = $resultUser->fetch_assoc();

        //cek poin cukup tidak 
        if($user["poin"] < $voucher["poin_diperlukan"]){
            return "poin_kurang";
        }

        //kurangi poin user
        $sql = "UPDATE users SET poin = poin - '{$voucher['poin_diperlukan']}' WHERE id_user = '$id_user'";
        $connect->query($sql);

        //Simpan ke user_voucher
        $sql = "INSERT INTO user_vouchers (id_user, id_voucher, status) VALUES ('$id_user', '$id_voucher', 'aktif')";
        $connect->query($sql);
        return "berhasil";
    }

    function voucherSaya($connect, $id_user){
        $result = $connect->query("SELECT user_vouchers.*, vouchers.nama, vouchers.tipe, vouchers.nilai 
                            FROM user_vouchers 
                            JOIN vouchers ON user_vouchers.id_voucher = vouchers.id_voucher 
                            WHERE user_vouchers.id_user = '$id_user' AND user_vouchers.status = 'aktif'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function pakaiVoucher($connect, $id_order, $id_user_vouchers){
        $totalDiskon = 0;

        foreach($id_user_vouchers as $value){
            //ambil data voucher
            $sql = "SELECT user_vouchers.*, vouchers.nilai 
                    FROM user_vouchers 
                    JOIN vouchers ON user_vouchers.id_voucher = vouchers.id_voucher 
                    WHERE user_vouchers.id = '$value'";
            $result = $connect->query($sql);
            $voucher = $result->fetch_assoc();

            //simpan ke orders_voucher
            $sql = "INSERT INTO order_vouchers (id_order, id_user_voucher) VALUES ('$id_order', '$value')";
            $connect->query($sql);

            //ubah status voucher jadi terpakai
            $sql = "UPDATE user_vouchers SET status = 'terpakai' WHERE id = '$value'";
            $totalDiskon += $voucher["nilai"];
        }
        return $totalDiskon;
    }
?>