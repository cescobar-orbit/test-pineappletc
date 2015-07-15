<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $productcode
 * @property string $productname
 * @property string $description
 * @property string $price
 * @property integer $displayable
 * @property integer $providerid
 * @property string $category
 * @property string $image
 * @property integer $taxable
 *
 * The followings are the available model relations:
 * @property Provider $provider
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productcode, productname, price, description, providerid, category', 'required'),
			array('displayable, providerid, taxable', 'numerical', 'integerOnly'=>true),
			array('productcode', 'length', 'max'=>50),
			array('productname, category', 'length', 'max'=>100),
			array('price', 'length', 'max'=>10),
			array('image', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, productcode, productname, description, price, displayable, providerid, category', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'provider' => array(self::BELONGS_TO, 'Provider', 'providerid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'productcode' => 'Product code',
			'productname' => 'Product name',
			'description' => 'Description',
			'price' => 'Price',
			'displayable' => 'Displayable',
			'providerid' => 'Providerid',
			'category' => 'Category',
			'image' => 'Image',
			'taxable' => 'Taxable'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('productcode',$this->productcode,true);
		$criteria->compare('productname',$this->productname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('displayable',$this->displayable);
		$criteria->compare('providerid',$this->providerid);
		$criteria->compare('taxable',$this->taxable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
