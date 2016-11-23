<?php

class Paginator
{
  protected $leftBoundary  = null;
  protected $rightBoundary = null;

  protected $maxButton   = null;
  protected $lastPage    = null;
  protected $currPage    = null;
  protected $rowsPerPage = null;
  protected $totalData   = null;
  
  public function __construct($totalData, $currPage, $maxButton, $rowsPerPage)
  {
    $this->maxButton   = $maxButton;
    $this->currPage    = $currPage;
    $this->rowsPerPage = $rowsPerPage;
    $this->totalData   = $totalData;

    $this->setBoundaries();
    $this->setLastPage();
  }

  public function setLastPage()
  {
    if ($this->totalData <= $this->rowsPerPage) {
      $this->lastPage = 1;
    } else {
      $this->lastPage = ceil($this->totalData / $this->rowsPerPage);
    }
  }

  public function setBoundaries()
  {
    if (($this->maxButton % 2) === 0) {
      $this->leftBoundary = ($this->maxButton / 2) - 1;
    } else {
      $this->leftBoundary = ($this->maxButton - 1) / 2;
    }

    $this->rightBoundary = $this->maxButton - $this->leftBoundary - 1;
  }

  public function isPageExists()
  {
    return (ctype_digit(strval($this->currPage)) && ($this->currPage > 0 && $this->currPage <= $this->lastPage));
  }

  public function getCurrentPage()
  {
    return ($this->currPage > $this->lastPage) ? $this->lastPage : $this->currPage;
  }

  public function getItemsPerPage()
  {
    return $this->rowsPerPage;
  }

  public function getOffset()
  {
    return ($this->currPage - 1) * $this->rowsPerPage;
  }

  public function isCurrentPage($pageNumber)
  {
    return ((int)$pageNumber === (int)$this->currPage);
  }

  public function hasData()
  {
    return ($this->totalData > 0);
  }

  public function hasPrevious()
  {
    return ($this->getPrevious() > 0);
  }
  
  public function getPrevious()
  {
    return ($this->currPage - 1);
  }
  
  public function hasNext()
  {
    return ($this->getNext() <= $this->lastPage);
  }

  public function getNext()
  {
    return ($this->currPage + 1);  
  }

  public function getPageNumbers()
  {
    $buttons = array();

    if (($this->currPage - $this->leftBoundary) < 1 || $this->lastPage <= $this->maxButton) {
      $firstButton = 1;
      $lastButton  = $this->lastPage;
    } elseif (($this->currPage + $this->rightBoundary) > $this->lastPage) {
      $firstButton = $this->lastPage - $this->maxButton + 1;
      $lastButton  = $this->lastPage;
    } else {
      $firstButton = $this->currPage - $this->leftBoundary;
      $lastButton  = $this->currPage + $this->rightBoundary;
    }

    $maxLoop = ($lastButton < $this->maxButton) ? $lastButton : $this->maxButton;
    
    for ($i = 0; $i < $maxLoop; $i++) {
      $buttons[] = $firstButton + $i;
    }
    
    return $buttons;
  }
}
