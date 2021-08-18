 <?php 

use kartik\tabs\TabsX;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
  
$this->title = 'Floor Plan';

   echo Tabs::widget([
    'items' => [
        [
            'label' => 'Type A',
            'content' => '<img src="statics/web/sample-image.jpg">',
			'headerOptions' => ['style'=>'font-weight:bold'],
            'active' => true
        ],
        [
            'label' => 'Type B',
            'content' => '<img src="statics/web/typeB.jpg">',
			'headerOptions' => ['style'=>'font-weight:bold'],
        ], 
		[
            'label' => 'Type C',
            'content' => '<img src="statics/web/typeC.jpg">',
			'headerOptions' => ['style'=>'font-weight:bold'],
        ],
		[
            'label' => 'Type C1|C3',
            'content' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
			'headerOptions' => ['style'=>'font-weight:bold'],
		], 
		[
            'label' => 'Type C2',
            'content' => '<img src="statics/web/sample-image.jpg">',
			'headerOptions' => ['style'=>'font-weight:bold'],
        ], 
		[
            'label' => 'Type C5',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
			'headerOptions' => ['style'=>'font-weight:bold'],
        ],
        
        
    ],
]);
	
	?>
	