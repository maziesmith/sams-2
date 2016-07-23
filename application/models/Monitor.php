<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Monitor extends CI_Model {

    private $members_table = 'members';
    private $groups_table = 'groups';
    private $levels_table = 'levels';
    private $dtr_table = 'dtr_log';

    function __construct()
    {
        parent::__construct();
    }

    public function all_members()
    {
        $query = $this->db->get($this->members_table);
        return $query->result();
    }

    public function all_levels()
    {
        $query = $this->db->get($this->levels_table);
        return $query->result();
    }

    public function all_groups()
    {
        $query = $this->db->get($this->groups_table);
        return $query->result();
    }
    public function get_filter(&$a,&$b)
    {
        if($a=="Contact"):
            $this->db->where('members.id', $b);
            $query = $this->db->get($this->members_table);
            foreach ($query->result() as $row)
            {
                $fullname = $row->firstname;
                $fullname.= " ".$row->middlename;
                $fullname.= " ".$row->lastname;
            }
            echo $fullname;
        elseif($a=="Level"):
            $this->db->where('levels.levels_id', $b);
            $query = $this->db->get($this->levels_table);
            foreach ($query->result() as $row)
            {
                $levelname = $row->levels_name;
            }
            echo $levelname;
        elseif($a=="Group"):
            $this->db->where('groups.groups_id', $b);
            $query = $this->db->get($this->groups_table);
            foreach ($query->result() as $row)
            {
                $groupname = $row->groups_name;
            }
            echo $groupname;
        endif;
    }

    public function generate_csv($a,$b,$c,$d,$e,$f,$g,$h)
    {
    $date_from = date("Y-m-d",strtotime(str_replace('/', '-', $a)));
    $date_end = date("Y-m-d",strtotime(str_replace('/', '-', $b)));

    $this->load->dbutil();
    if($c=="Level"):

        $this->db->select('mem.firstname,mem.lastname,dtr.timelog');
        $this->db->from('dtr_log as dtr');
        $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
        $this->db->join('levels as lv', 'mem.level = lv.levels_id');
        $this->db->where('lv.levels_id', $d);
        $this->db->like('dtr.timelog',$date_from);
        $this->db->where('dtr.timelog >=',$date_from.' '.$g);
        $this->db->where('dtr.timelog <=',$date_from.' '.$h);
        $this->db->order_by('mem.firstname', $f);
        
    elseif($c=="Group"):
        
        $this->db->select('mem.firstname,mem.lastname,dtr.timelog');
        $this->db->from('dtr_log as dtr');
        $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
        $this->db->join('group_members as gpm', 'mem.id = gpm.member_id');
        $this->db->join('groups as gp', 'gpm.group_id = gp.groups_id');
        $this->db->where('gp.groups_id', $d);
        $this->db->like('dtr.timelog',$date_from);
        $this->db->where('dtr.timelog >=',$date_from.' '.$g);
        $this->db->where('dtr.timelog <=',$date_from.' '.$h);
        $this->db->order_by('mem.firstname', $f);

    elseif($c=="Contact"):

        $this->db->select('mem.firstname,mem.lastname,dtr.timelog');
        $this->db->from('dtr_log as dtr');                
        $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
        $this->db->like('dtr.timelog',$date_from);
        $this->db->where('dtr.timelog >=',$date_from.' '.$g);
        $this->db->where('dtr.timelog <=',$date_from.' '.$h);
        $this->db->where('mem.id',$d);
        $this->db->order_by('mem.firstname', $f);
        $this->db->order_by('dtr.id', $f);
        
    else:
        
        $this->db->select('mem.firstname,mem.lastname,dtr.timelog');
        $this->db->from('dtr_log as dtr');                
        $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
        $this->db->like('dtr.timelog',$date_from);
        $this->db->where('dtr.timelog >=',$date_from.' '.$g);
        $this->db->where('dtr.timelog <=',$date_from.' '.$h);
        $this->db->order_by('mem.firstname', $f);
        $this->db->order_by('dtr.id', $f);
    endif;
        $query = $this->db->get();
        $delimiter = ",";
        $newline = "\r\n";
        return $this->dbutil->csv_from_result($query,$delimiter,$newline);
    }



    public function get_fullname($fname)
    {
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where('members.id', $fname);
        $query1 = $this->db->get();
        foreach($query1->result() as $row1 ){
           $fname = $row1->firstname.' '.$row1->middlename.' '.$row1->lastname;
        }
        return $fname; 
        $this->db->close();
    }

    public function get_levels($levels)
    {
        $this->db->select('*');
        $this->db->from('members as mem');        
        $this->db->join('levels as lv', 'mem.level = lv.levels_id');
        $this->db->where('mem.id',$levels);
        $query2 = $this->db->get();
        foreach($query2->result() as $row2 ){
            $levels = $row2->levels_name;
        }
        return $levels; 
        $this->db->close();
    }

    public function get_dtrlog_am_in($stud_no,$timelog,$timefrom,$timeto){
        $this->db->select('*');
        $this->db->like('dtr.timelog',$timelog);
        $this->db->where('dtr.timelog >=',$timelog.' '.$timefrom);
        $this->db->where('dtr.member_id',$stud_no);
        $this->db->where('dtr.mode','1');
        $this->db->order_by('dtr.id','asc');
        $query2 = $this->db->get($this->dtr_table.' as dtr','1');
        foreach($query2->result() as $row2 ){
            $timelog = date("H:i:s", strtotime($row2->timelog));
        }
        return $query2->num_rows()==1 ? $timelog : '';
        $this->db->close(); 
    }
    public function get_dtrlog_am_out($stud_no,$timelog,$timefrom,$timeto){
        $this->db->select('*');
        $this->db->like('dtr.timelog',$timelog);
        $this->db->where('dtr.timelog >=',$timelog.' '.$timefrom);
        $this->db->where('dtr.member_id',$stud_no);
        $this->db->where('dtr.mode','2');
        $this->db->order_by('dtr.id','desc');
        $query2 = $this->db->get($this->dtr_table.' as dtr','1');
        foreach($query2->result() as $row2 ){
            $timelog = date("H:i:s", strtotime($row2->timelog));
        }
        return $query2->num_rows()==1 ? $timelog : '';
        $this->db->close(); 
        echo 'ss';
    }
    public function get_dtrlog_pm_in($stud_no,$timelog,$timefrom,$timeto){
        $this->db->select('*');
        $this->db->like('dtr.timelog',$timelog);
        $this->db->where('dtr.timelog >=',$timelog.' '.$timefrom);
        $this->db->where('dtr.member_id',$stud_no);
        $this->db->where('dtr.mode','3');
        $this->db->order_by('dtr.id','asc');
        $query2 = $this->db->get($this->dtr_table.' as dtr','1');
        foreach($query2->result() as $row2 ){
            $timelog = date("H:i:s", strtotime($row2->timelog));
        }
        return $query2->num_rows()==1 ? $timelog : '';
        $this->db->close(); 
    }
    public function get_dtrlog_pm_out($stud_no,$timelog,$timefrom,$timeto){
        $this->db->select('*');
        $this->db->like('dtr.timelog',$timelog);
        $this->db->where('dtr.timelog >=',$timelog.' '.$timefrom);  
        $this->db->where('dtr.member_id',$stud_no);
        $this->db->where('dtr.mode','4');
        $this->db->order_by('dtr.id','desc');
        $query2 = $this->db->get($this->dtr_table.' as dtr','1');
        foreach($query2->result() as $row2 ){
            $timelog = date("H:i:s", strtotime($row2->timelog));
        }
        return $query2->num_rows()==1 ? $timelog : '';
        $this->db->close(); 
    }
    public function generate_dtr(&$a,&$b,&$c,&$d,&$e,&$f,&$g,&$h)
    {   
    $date_from = date("Y-m-d",strtotime(str_replace('/', '-', $a)));
    $date_end = date("Y-m-d",strtotime(str_replace('/', '-', $b)));
        if($e=="Summary"):
            if($c=="Contact"):
                $this->db->select('*'); 
                $this->db->from('members as mem');
                $this->db->where('mem.id', $d);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();
            elseif($c=="Level"):
                $this->db->select('*');    
                $this->db->from('members as mem');
                $this->db->join('levels as lv', 'mem.level = lv.levels_id');
                $this->db->where('lv.levels_id', $d);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();
            elseif($c=="Group"):
                $this->db->select('*');    
                $this->db->from('members as mem');
                $this->db->join('group_members as gpm', 'mem.id = gpm.member_id');
                $this->db->join('groups as gp', 'gpm.group_id = gp.groups_id');
                $this->db->where('gp.groups_id', $d);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();  
            else:
                $this->db->select('*');    
                $this->db->from('members as mem');
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();   
            endif;
        else: 
            if($c=="Contact"):
                $this->db->select('*');
                $this->db->from('dtr_log as dtr');                
                $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
                $this->db->like('dtr.timelog',$date_from);
                $this->db->where('dtr.timelog >=',$date_from.' '.$g);
                $this->db->where('dtr.timelog <=',$date_from.' '.$h);
                $this->db->where('mem.id',$d);
                $this->db->order_by('mem.firstname', $f);
                $this->db->order_by('dtr.id', $f);
                $query = $this->db->get();
                return $query->result();
            elseif($c=="Level"):
                $this->db->select('*');
                $this->db->from('dtr_log as dtr');
                $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
                $this->db->join('levels as lv', 'mem.level = lv.levels_id');
                $this->db->where('lv.levels_id', $d);
                $this->db->like('dtr.timelog',$date_from);
                $this->db->where('dtr.timelog >=',$date_from.' '.$g);
                $this->db->where('dtr.timelog <=',$date_from.' '.$h);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();
            elseif($c=="Group"):
                $this->db->select('*');
                $this->db->from('dtr_log as dtr');
                $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
                $this->db->join('group_members as gpm', 'mem.id = gpm.member_id');
                $this->db->join('groups as gp', 'gpm.group_id = gp.groups_id');
                $this->db->where('gp.groups_id', $d);
                $this->db->like('dtr.timelog',$date_from);
                $this->db->where('dtr.timelog >=',$date_from.' '.$g);
                $this->db->where('dtr.timelog <=',$date_from.' '.$h);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();  
            else:
                $this->db->select('*');
                $this->db->from('dtr_log as dtr');
                $this->db->join('members as mem', 'dtr.member_id = mem.stud_no');
                $this->db->like('dtr.timelog',$date_from);
                $this->db->where('dtr.timelog >=',$date_from.' '.$g);
                $this->db->where('dtr.timelog <=',$date_from.' '.$h);
                $this->db->order_by('mem.firstname', $f);
                $query = $this->db->get();
                return $query->result();   
            endif;
        endif;
    }    
}