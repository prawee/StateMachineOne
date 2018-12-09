<?php
namespace eftec\statemachineone;
use eftec\MessageItem;
use eftec\MessageList;



/**
 * Class Job
 * @package eftec\statemachineone
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 1.0 2018-12-08
 * @link https://github.com/EFTEC/StateMachineOne
 */
class Job {
	/** @var int number or position of the job on the queue */
    var $idJob=0;
    /** @var int[] reference value. For example, (order number) or (order number, customer id) */
    var $idRef;
    /** @var int */
    var $dateInit;
	/** @var int */
	var $dateLastChange;    
    /** @var int */
    var $dateEnd;
    /** @var int */
    var $dateExpired;    
    /** @var mixed */
    var $state;
    /** @var array */
    var $fields;
    /** 
     * none= the job doesn't exist or it's deleted.
     * inactive= the job exists but it hasn't started
     * active = the job is running
     * pause = the job is paused
     * stop = the job has ended (succesfully,cancelled or other)
     * @var string ['none','inactive','active','pause','stop'][$i]
     */
    private $active='none';

    var $isNew=false;
    var $isUpdate=false;

    /** @var MessageItem[] */
    var $messages;    
    /** @var array */
    var $log;

    /**
     * StateMachineJob constructor.
     */
    public function __construct()
    {
        $this->messages=[];
        $this->log=[];
    }


    /**
     * @param int[] $idRef
     * @return Job
     */
    public function setIdRef(array $idRef): Job
    {
        $this->idRef = $idRef;
        return $this;
    }

    /**
     * @param int $dateInit
     * @return Job
     */
    public function setDateInit(int $dateInit): Job
    {
        $this->dateInit = $dateInit;
        return $this;
    }

	/**
	 * @param int $dateLastChange
	 * @return Job
	 */
	public function setDateLastChange(int $dateLastChange): Job
	{
		$this->dateLastChange = $dateLastChange;
		return $this;
	}
    /**
     * @param int $dateEnd
     * @return Job
     */
    public function setDateEnd(int $dateEnd): Job
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
     * @param int $dateExpired
     * @return Job
     */
    public function setDateExpired(int $dateExpired): Job
    {
        $this->dateExpired = $dateExpired;
        return $this;
    }

    /**
     * @param mixed $state
     * @return Job
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param array $fields
     * @return Job
     */
    public function setFields(array $fields): Job
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string $active= ['none','inactive','active','pause','stop','success'][$i]
     * @return Job
     */
    public function setActive($active): Job
    {
        $this->active=$active;
        return $this;
    }
    public function setActiveNumber($activeNum): Job
    {
        switch ($activeNum) {
            case 0: $this->active='none'; break;
            case 1: $this->active='inactive'; break;
            case 2: $this->active='active'; break;
            case 3: $this->active='pause'; break;
            case 4: $this->active='stop'; break;
            default: $this->active='none'; break;
        }
        return $this;
    }

    /**
     * @return string= ['none','inactive','active','pause','stop','success'][$i]
     */
    public function getActive() {
        return $this->active;
    }
    public function getActiveNumber() {
        switch ($this->active) {
            case 'none':
                return 0;
            case 'inactive':
                return 1;
            case 'active':
                return 2;
            case 'pause':
                return 3;
            case 'stop':
                return 4;
            default:
                trigger_error("type active not defined");
                return -1;
        }
    }    

    /**
     * @param bool $isNew
     * @return Job
     */
    public function setIsNew(bool $isNew): Job
    {
        $this->isNew = $isNew;
        return $this;
    }

    /**
     * @param bool $isUpdate
     * @return Job
     */
    public function setIsUpdate(bool $isUpdate): Job
    {
        $this->isUpdate = $isUpdate;
        return $this;
    }
    
    
    
} // end StateMachineJob
