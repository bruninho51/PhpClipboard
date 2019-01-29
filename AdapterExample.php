<?php

use PhpClipboard\Contracts\IPhpClipboardDBAdapter;

class AdapterExample implements IPhpClipboardDBAdapter
{
    private $con;

    public function __construct()
    {
        $this->con = new PDO("mysql:host=mysql;dbname=workorganize;charset=utf8", "root", "root");
    }

    public function getForm(int $formIdx) : array
    {
        $data = [];
        $stmt = $this->con->prepare("SELECT * FROM formulario WHERE idFormulario = ?");
        $stmt->bindParam(1,$formIdx);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data = $reg;
                }
            }
        }
        return $data;
    }

    public function getFormEntries(int $formIdx) : array
    {
        $data = [];
        $stmt = $this->con->prepare("SELECT * FROM campos C JOIN camposFormulario CF ON CF.idCampo = C.idCampo WHERE CF.idFormulario = ?");
        $stmt->bindParam(1,$formIdx);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $reg;
                }
            }
        }
        return $data;
    }
    
    public function getEntryRoles(int $inputIdx) : array
    {
        $data = [];
        $stmt = $this->con->prepare("SELECT * FROM rolesEntry WHERE idCampo = ?");
        $stmt->bindParam(1, $inputIdx);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $reg;
                }
            }
        }
        return $data;
    }

    public function getEntryOpt(int $inputIdx): array 
    {
        $sql = null;

        $stmt = $this->con->prepare("SELECT opt FROM campos WHERE idCampo = ?");
        $stmt->bindParam(1, $inputIdx);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $sql = $stmt->fetch(PDO::FETCH_ASSOC)['opt'];
            }
        }

        $data = [];
        if ($sql != null) {
            $stmt = $this->con->prepare($sql);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[] = $reg;
                    }
                }
            }
        }

        return $data;
    }

}