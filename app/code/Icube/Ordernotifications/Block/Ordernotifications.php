<?phpnamespace Icube\Ordernotifications\Block;use Magento\Framework\View\Element\Template;use Icube\Ordernotifications\Model\OrdernotificationsFactory;class Ordernotifications extends Template{		protected $_ordernotificationsFactory;	    	public function __construct(      Template\Context $context,      OrdernotificationsFactory $ordernotificationsFactory,      array $data = []   ) {        $this->_ordernotificationsFactory = $ordernotificationsFactory;        parent::__construct($context, $data);   }      protected  function _construct()    {        parent::_construct();		$om = \Magento\Framework\App\ObjectManager::getInstance();		$customerSession = $om->get('Magento\Customer\Model\Session');		if($customerSession->isLoggedIn()) {			$collection = $this->_ordernotificationsFactory->create()->getCollection()				->addFieldToFilter('to',  $customerSession->getCustomer()->getEmail())				->setOrder('ordernotifications_id', 'DESC');			$this->setCollection($collection);		}    }       protected function _prepareLayout()    {        parent::_prepareLayout();        /** @var \Magento\Theme\Block\Html\Pager */        $pager = $this->getLayout()->createBlock(           'Magento\Theme\Block\Html\Pager',           'icube.ordernotifications.list.pager'        );        $pager->setLimit(5)            ->setShowAmounts(false)            ->setCollection($this->getCollection());        $this->setChild('pager', $pager);        $this->getCollection()->load();         return $this;    }		public function getPagerHtml()    {        return $this->getChildHtml('pager');    }}