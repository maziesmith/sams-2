<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Outbox extends CI_Model {
    private $table = 'outbox';
    private $column_id = 'id';
    private $column_softDelete = 'removed_at';
    private $column_softDeletedBy = 'removed_by';
    public $validate = array(
        array( 'field' => 'msisdn', 'label' => 'Name', 'rules' => 'trim' ),
    );

    function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function all($removed_only=false, $select="*")
    {
        if( $removed_only ) return $this->db->select($select)->where($this->column_softDelete ." != ", NULL)->get($this->table)->result();
        $query = $this->db->where($this->column_softDelete, NULL)->get($this->table);
        return $query->result();
    }

    public function get_all($start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        if( null != $sort )
        {
            foreach ($sort as $field_name => $order) {
                $this->db->order_by($field_name, $order);
            }
        }

        $this->db->limit( $limit, $start_from );

        if( $removed_only ) return $this->db->where($this->column_softDelete . " != ", NULL)->get($this->table);
        return $this->db->where($this->column_softDelete, NULL)->get($this->table);
    }

    public function find($id, $column=null)
    {
        if (null != $column) {
            $query = $this->db->where($column, $id)->get($this->table);
            return $query->row();
        }

        if ( is_array($id) ) return $this->db->where_in($this->column_id, $id)->get($this->table);

        $query = $this->db->where($this->column_id, $id)->get($this->table);
        return $query->row();
    }

    public function like($wildcard='', $start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        $this->db->where('message_id LIKE ', '%'. $wildcard . '%')
                ->or_where('member_id LIKE ', '%'. $wildcard . '%')

                ->or_where('group_id', '%'. $wildcard)

                ->or_where('msisdn LIKE ', '%'. $wildcard . '%')
                ->or_where('sms LIKE ', '%'. $wildcard . '%')
                ->or_where('status LIKE ', '%'. $wildcard . '%')

                ->from($this->table)
                ->select('*');

        if( null != $sort ) {
            foreach ($sort as $field_name => $order) {
                $this->db->order_by($field_name, $order);
            }
        }

        $this->db->limit( $limit, $start_from );

        if( $removed_only ) return $this->db->where($this->column_softDelete . " !=", NULL)->get();
        return $this->db->where($this->column_softDelete, NULL)->get();
    }

    public function tracking($wildcard='', $start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        $q  = "SELECT ms.id, ms.message, ob.status, COUNT(*) AS contacts,";
        $q .= " SUM(IF(ob.status='pending', 1, 0)) as pending,";
        $q .= " SUM(IF(ob.status='success', 1, 0)) as successful,";
        $q .= " SUM(IF(ob.status='reject', 1, 0)) as rejected,";
        $q .= " SUM(IF(ob.status='failure', 1, 0)) as failure,";
        $q .= " SUM(IF(ob.status='buffered', 1, 0)) as buffered";
        $q .= " FROM outbox ob JOIN messages ms ON ms.id = ob.message_id";
        $q .= " WHERE ob.status LIKE '%$wildcard'";
        $q .= " OR ms.message LIKE '%$wildcard%'";
        $q .= " AND ob.removed_by IS NULL";
        if( null != $sort ) {
            $q .= " ORDER BY";
            foreach ($sort as $field_name => $order) {
                $q .= " $field_name, $order, ";
            }
        }
        $q .= " GROUP BY ms.message";
        if (0 != $limit || null != $limit) $q .= " LIMIT $limit";
        if (0 != $start_from || null != $start_from) $q .= " OFFSET $start_from";
        return $this->db->query($q);
    }

    public function tracking_status_count($value, $column='status')
    {
        $q  = "SELECT ms.id, ms.message,";
        $q .= " SUM(IF(ob.$column='$value', 1, 0)) as $value";
        $q .= " FROM outbox ob JOIN messages ms ON ms.id = ob.message_id";
        $q .= " WHERE ob.removed_by IS NULL";
        $q .= " AND ob.$column='$value'";
        // $q .= " GROUP BY ms.id";
        return $this->db->query($q);
    }

    public function tracking_all($start_from=0, $limit=0, $sort=null, $removed_only=false)
    {
        $q  = "SELECT ms.id, ms.message, COUNT(*) AS contacts,";
        $q .= " SUM(IF(ob.status='pending', 1, 0)) as pending,";
        $q .= " SUM(IF(ob.status='success', 1, 0)) as successful,";
        $q .= " SUM(IF(ob.status='reject', 1, 0)) as rejected,";
        $q .= " SUM(IF(ob.status='failure', 1, 0)) as failure,";
        $q .= " SUM(IF(ob.status='buffered', 1, 0)) as buffered";
        $q .= " FROM outbox ob JOIN messages ms ON ms.id = ob.message_id";
        $q .= " WHERE ob.removed_by IS NULL";
        // if( null != $sort ) {
        //     $q .= " ORDER BY";
        //     foreach ($sort as $field_name => $order) {
        //         $q .= " $field_name, $order ";
        //     }
        // }
        $q .= " GROUP BY ms.message";
        if (0 != $limit || null != $limit) $q .= " LIMIT $limit";
        if (0 != $start_from || null != $start_from) $q .= " OFFSET $start_from";
        // $q .= " OFFSET ". (!empty($start_from)?$start_from:-1);
        return $this->db->query($q);
    }
}
 ?>