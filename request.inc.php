<?php
  class funding
  {
    public $funding_id;
    public $fund;
    public $org;
    public $program;
    public $account;
    public $amount;
    public $pre;

    public function funding($pre = '', $fund_id = '', $fund = '',$org = '', $program = '', account = '', amount = '')
    {
      $this->pre = $pre;
      $this->fund_id = $fund_id;
      $this->fund = $fund;
      $this->org = $org;
      $this->program = $program;
      $this->account = $account;
      $this->amount = $amount;
    }

    public function sanitize()
    {
    }

    public function validate($errors = array())
    {
    }

    public function form($errors = array())
    {
    }

    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete() 
    {
    }
  };

  class fund_item
  {
    public $fund_item_id;
    public $pcard;
    public $tcard;
    public $cash;
    public $pre;

    function fund_item($pre = '',$fund_item_id = '',$pcard = '',$tcard = '',$cash = '')
    {
      $this->pre = $pre;
      $this->fund_item_id = $fund_item_id;
      $this->pcard = $pcard;
      $this->tcard = $tcard;
      $this->cash = $cash;
    }

    public function sanitize()
    {
    }

    public function validate($errors = array())
    {
    }

    public function form($errors = array())
    {
    }

    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

  };


  class request
  {
    public $request_id;
    public $first_name;
    public $last_name;
    public $department;
    public $date;
    public $leave_start;
    public $leave_end;
    public $location;
    public $purpose;
    public $responsibilities;
    public $coverage;
    public $supervisor;
    public $sup_approval; //date
    public $division;
    public $dean;
    public $dean_approval; //date
    public $estimated_cost;
    public $fund_1;
    public $fund_2;
    public $registration_item;
    public $airline_item;
    public $hotel_item;
    public $agency_item;
    public $car_item;
    public $other_item;
    public $pre;


    public function request
    (
      $pre = '',
      $request_id = '',
      $first_name = '',
      $last_name = '',
      $department = '',
      $date = '',
      $leave_start = '',
      $leave_end = '',
      $location = '',
      $purpose = '',
      $responsibilities = '',
      $coverage = '',
      $supervisor = '',
      $sup_approval = '',
      $division = '',
      $dean = '',
      $dean_approval = '',
      $estimated_cost = '',
      $fund_1 = '',
      $fund_2 = '',
      $registration_item = '',
      $airline_item = '',
      $hotel_item = '',
      $agency_item = '',
      $car_item = '',
      $other_item = ''
    )
    {
      $this->pre = $pre;
      $this->request_id = request_id;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->department = $department;
      $this->date = $date;
      $this->leave_start = $leave_start;
      $this->leave_end = $leave_end;
      $this->location = $location; 
      $this->purpose = $purpose; 
      $this->responsibilities = $responsibilities;
      $this->coverage = $coverage;
      $this->supervisor = $supervisor;
      $this->sup_approval = $sup_approval;      
      $this->division = $division;
      $$this->dean = $dean;
      $$this->dean_approval = $dean_approval;  
      $this->estimated_cost = $estimated_cost;
      $this->fund_1 = $fund_1;
      $this->fund_2 = $fund_2;
      $this->registration_item = $registration_item;
      $this->airline_item = $airline_item;
      $this->hotel_item = $hotel_item;
      $this->agency_item = $agency_item;
      $this->car_item = $car_item;
      $this->other_item = $other_item;
    }

    public function sanitize()
    {
    }

    public function validate($errors = array())
    {
    }

    public function form($errors = array())
    {
      $class_first_name = 'required ' . (array_key_exists($errors,'first_name') ? 'error' : '');
      $class_last_name = 'required ' . (array_key_exists($errors,'last_name') ? 'error' : '');
      $class_department = 'required ' . (array_key_exists($errors,'department') ? 'error' : '');
      $class_date = 'required ' . (array_key_exists($errors,'date') ? 'error' : '');
      $class_leave_start = 'required ' . (array_key_exists($errors,'leave_start') ? 'error' : '');
      $class_leave_end = 'required ' . (array_key_exists($errors,'leave_end') ? 'error' : '');
      $class_location = 'required ' . (array_key_exists($errors,'location') ? 'error' : '');
      $class_purpose = 'required ' . (array_key_exists($errors,'purpose') ? 'error' : '');
      $class_responsibilities = 'required ' . (array_key_exists($errors,'responsibilities') ? 'error' : '');
      $class_coverage = 'required ' . (array_key_exists($errors,'coverage') ? 'error' : '');
      $class_supervisor = 'required ' . (array_key_exists($errors,'supervisor') ? 'error' : '');
      $class_sup_approval = 'required ' . (array_key_exists($errors,'sup_approval') ? 'error' : '');
      $class_division = 'required ' . (array_key_exists($errors,'division') ? 'error' : '');
      $class_dean = 'required ' . (array_key_exists($errors,'dean') ? 'error' : '');
      $class_dean_approval = 'required ' . (array_key_exists($errors,'dean_approval') ? 'error' : '');
      $class_estimated_cost = 'required ' . (array_key_exists($errors,'estimated_cost') ? 'error' : '');

//      $fund_1 = '',
//      $fund_2 = '',
//      $registration_item = '',
//      $airline_item = '',
//      $hotel_item = '',
//      $agency_item = '',
//      $car_item = '',
//      $other_item = ''

      $ret = array();
      $ret['html'] = '<label>First Name: <input type="test" value="first_name" 

    }

    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

  };
?>
