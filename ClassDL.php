<?php
    class SanPham{
        private $TenSP ;
        private $HinhAnh;
        private $ThanhTien;
        
        public function __construct() {
        }
        public function getTenSP()
        {
            return $this->TenSP;
        }
        public function setTenSP($dl)
        {
            $this->TenSP=$dl;
        }
        public function getHinhAnh()
        {
            return $this->HinhAnh;
        }
        public function setHinhAnh($dl)
        {
            $this->HinhAnh=$dl;
        }
        public function getThanhTien()
        {
            return $this->ThanhTien;
        }
        public function setThanhTien($dl)
        {
            $this->ThanhTien=$dl;
        }
    }
    class MaSanPham{
        private $MaSP ;
        private $Id_Gio;
        private $SoLuongMua;
        public function __construct() {
        }
        public function getMaSP()
        {
            return $this->MaSP;
        }
        public function setMaSP($dl)
        {
            $this->MaSP=$dl;
        }
        public function getIdGio()
        {
            return $this->Id_Gio;
        }
        public function setIdGio($dl)
        {
            $this->Id_Gio=$dl;
        }
        public function getSoLuongMua()
        {
            return $this->SoLuongMua;
        }
        public function setSoLuongMua($dl)
        {
            $this->SoLuongMua=$dl;
        }
    }
?>