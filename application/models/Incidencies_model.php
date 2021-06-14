<?php
class Incidencies_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function incidencia($marca_equip, $taller, $tecnic, $client, $estat, $descripcio) {

        $data = array(
            'marca_equip' => $marca_equip,
            'descripcio' => $descripcio,
            'taller' => $taller,
            'client' => $client,
            'tecnic' => $tecnic,
            'estat' => $estat,
        );

        return $this->db->insert('incidencies', $data);
    }

    public function getincidencies() {

        $query=$this->db->get("incidencies");
        return $query->result();
    }

    public function getincidencia($id) {
        $query = $this->db->get('incidencies', array('id_incidencia' => $id));
        return $query->result();
    }

    public function deleteincidencies($id) {
        return $this->db->delete('incidencies', array('id_incidencia' => $id));
    }
}