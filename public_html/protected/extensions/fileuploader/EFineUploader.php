<?php
/**
 * EFineUploader class file.
 * This extension is a wrapper of https://github.com/Widen/fine-uploader
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
        How to use:

        view:
$this->widget('ext.EFineUploader.EFineUploader',
 array(
       'id'=>'FineUploader',
       'config'=>array(
                       'autoUpload'=>true,
                       'request'=>array(
                                        'endpoint'=>'/files/upload',// OR $this->createUrl('files/upload'),
                                        'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                       ),
                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                       'callbacks'=>array(
                                          'onComplete'=>"js:function(id, name, response){  }",
                                          //'onError'=>"js:function(id, name, errorReason){ }",
                                         ),
                       'validation'=>array(
                                           'allowedExtensions'=>array('jpg','jpeg'),
                                           'sizeLimit'=>2 * 1024 * 1024,//maximum file size in bytes
                                           'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                                          ),
                       'messages'=>array(
                                         'typeError'=>"Файл {file} имеет неверное расширение. Разрешены файлы только с расширениями: {extensions}.",
                                         'sizeError'=>"Размер файла {file} велик, максимальный размер {sizeLimit}.",
                                         'minSizeError'=>"Размер файла {file} мал, минимальный размер {minSizeLimit}.",
                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                        ),
                      )
      ));

        controller:

        public function actionUpload()
        {
                $tempFolder=Yii::getPathOfAlias('webroot').'/upload/temp/';

                mkdir($tempFolder, 0777, TRUE);
                mkdir($tempFolder.'chunks', 0777, TRUE);

                Yii::import("ext.EFineUploader.qqFileUploader");

                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = array('jpg','jpeg');
                $uploader->sizeLimit = 2 * 1024 * 1024;//maximum file size in bytes
                $uploader->chunksFolder = $tempFolder.'chunks';

                $result = $uploader->handleUpload($tempFolder);
                $result['filename'] = $uploader->getUploadName();
                $result['folder'] = $webFolder;

                $uploadedFile=$tempFolder.$result['filename'];

                header("Content-Type: text/plain");
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
                Yii::app()->end();
        }

*/
class EFineUploader extends CWidget
{
    public $version="3.4.1";
	public $config=array();
	public $css=null;
    public $htmlOptions=array();
        
    public function run(){
		if(empty($this->config['request']['endpoint'])){
            throw new CException('EFineUploader: param "request::endpoint" cannot be empty.');
        }

		if(!is_array($this->config['validation']['allowedExtensions'])){
            throw new CException('EFineUploader: param "validation::allowedExtensions" must be an array.');
        }

		if(empty($this->config['validation']['sizeLimit'])){
		      throw new CException('EFineUploader: param "validation::sizeLimit" cannot be empty.');
        }

        unset($this->config['element']);

        if(!isset($this->htmlOptions['id'])){
            $this->htmlOptions['id'] = "fineUploader";
        }

        echo CHtml::tag('div',$this->htmlOptions,'<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>');

		$assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);

        $fJs=(YII_DEBUG)?$baseUrl."/jquery.fineuploader-{$this->version}.js":$baseUrl."/jquery.fineuploader-{$this->version}.min.js";
        Yii::app()->clientScript->registerScriptFile($fJs, CClientScript::POS_HEAD);

        $this->css=(!empty($this->css))?$this->css:$baseUrl."/fineuploader-{$this->version}.css";
        Yii::app()->clientScript->registerCssFile($this->css);

		$config = array(
            'element'=>'js:document.getElementById("'.$this->htmlOptions['id'].'")',
            'debug'=>false,
            'multiple'=>false,
            'text'=>array(
                'uploadButton'=> Yii::t('view','Upload a file'),
                'cancelButton'=> Yii::t('view','Cancel'),
                'retryButton'=> Yii::t('view','Retry'),
                'deleteButton'=> Yii::t('view','Delete'),
                'failUpload'=> Yii::t('view','Upload failed'),
                'dragZone'=> Yii::t('view','Drop files here to upload'),
                'dropProcessing'=>Yii::t('view','Processing dropped files...'),
                'formatProgress'=> Yii::t('view',"{percent}% of {total_size}"),
                'waitingForResponse'=> Yii::t('view',"Processing..."),
            ),
            'messages'=>array(
                'typeError'=>Yii::t("view","File {file} has an incorrect extension. Allowed only files with the following extensions: {extensions}."),
                'sizeError'=>Yii::t("view","File size {file} is large, the maximum size of {sizeLimit}."),
                'minSizeError'=>Yii::t("view","File size {file} is small, the minimum size {minSizeLimit}."),
                'emptyError'=>Yii::t("view","{file} is empty, please select files again without it."),
                'onLeave'=>Yii::t("view","The files are being uploaded, if you leave now the upload will be cancelled."),
            ),
        );

        $config = array_merge($config, $this->config);
//		$config['params']=$postParams;
		$config = CJavaScript::encode($config);
        Yii::app()->getClientScript()->registerScript("FineUploader_".$this->htmlOptions['id'], "var FineUploader_".$this->htmlOptions['id']." = new qq.FineUploader($config);",CClientScript::POS_LOAD);
	}
}