<?php  
   class select extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }  
      //we will use the select function  
      public function selectSub()  
      {  
         //data is retrive from this query  
         $query = $this->db->get('exam_sub');  
         return $query;  
      }
      public function selectquestion($sub_id)  
      {  

         //data is retrive from this query  
         $this->db->select('sub_id,que_id,question,ans1,ans2,ans3,ans4,true_ans');
         // $this->db->select('')
        $this->db->from('exam_qus');
        $this->db->where('sub_id', $sub_id);
        return $this->db->get();
      }
      public function insert_result($data)
      {
        $result = $this->db->insert('exam_result', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
      }

       public function get_result($user_id, $sub_id) {
           $this->db->select('*');
           $this->db->from('exam_result');
           $this->db->where('user_id', $user_id);
           $this->db->where('sub_id', $sub_id);
           return $this->db->get();
       }

      // NOT USED
      public function getresults()
      {
        // $this->db->select('*');
        // $this->db->from('exam_result');
        $query = $this->db->get('exam_result');
        // $query2 = $this->db->get('tbl_users')  
         return $query;
         // return $query2;

      }
      public function getemail()
      {

        $query2 = $this->db->get('tbl_users'); 
         return $query2;

      }

   }  
