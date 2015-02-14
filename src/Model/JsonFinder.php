<?php

namespace Model;

class JsonFinder implements FinderInterface
{
    private $file;

    public function __construct($fileName)
    {
        $this->file = $fileName;
    /*
        $status1 = new Status(0, new \DateTime(), "Admin", "Test status 1");
        $status2 = new Status(1, new \DateTime(), "Admin", "plop plop plop");
        $status3 = new Status(2, new \DateTime(), "Admin", "toto lasticot");
        $this->json_encode_object($fileName, $status1);
        $this->json_encode_object($fileName, $status2);
        $this->json_encode_object($fileName, $status3);
    * */
    }

    private function json_encode_object($fileName, Status $object)
    {
        $array_to_encode = $this->create_array_from_object($object);
        $array_decode = json_decode(file_get_contents($fileName), true);

        //On sors de la fonction si id existe
        foreach ($array_decode as $item) {
            $item_raw_id = $item['id'];
            if ($item_raw_id == $object->getId()) {
                    return;
            }
        }
        //Si id existe pas
        $array_decode[] = $array_to_encode;
        file_put_contents($fileName, json_encode($array_decode, JSON_FORCE_OBJECT) . "\n");

        //var_dump(count($array_decode));
    }

    private function create_status_list_from_array($array_decode)
    {
        $status_array = array();
        foreach ($array_decode as $item) {
            $status_array[] = $this->create_status_from_array($item);
        }

        return $status_array;
    }

    private function create_status_from_array($item)
    {
        $status_id = $item['id'];
        $status_owner = $item['object'][1]['owner'];
        $status_text = $item['object'][2]['text'];
        $status_date = $item['object'][0]['date'];
        $status_real_date = new \DateTime($status_date['date'], new \DateTimeZone($status_date['timezone']));

        return new Status($status_id, $status_real_date, $status_owner, $status_text);
    }

    private function create_object_from_array($array_decode, $id)
    {
        foreach ($array_decode as $item) {
            if ($item['id'] == $id) {
                //var_dump($item['object'][1]['owner']);
                return $this->create_status_from_array($item);
            }
        }
    }

    private function create_array_from_object(Status $object)
    {
        $array = array();
        $array[] = array( 'date' => $object->getDate());
        $array[] = array( 'owner' => $object->getOwner());
        $array[] = array( 'text' => $object->getText());

        $array_to_encode['id'] = $object->getId();
        $array_to_encode['object'] = $array;

        return $array_to_encode;
    }

    /**
    * Returns all elements.
    *
    * @return array
    */
    public function findAll()
    {
        $array_decode = json_decode(file_get_contents($this->file), true);

        return $this->create_status_list_from_array($array_decode);

    }

    /**
    * Retrieve an element by its id.
    *
    * @param mixed $id
    * @return null|mixed
    */
    public function findOneById($id)
    {
        $array_decode = json_decode(file_get_contents($this->file), true);

        if($status = $this->create_object_from_array($array_decode, $id))

            return $status;

        return null;
    }

    public function newId()
    {
        return substr(number_format(time() * rand(),0,'',''),0,10);
    }

    public function addNewStatus(Status $status)
    {
        $this->json_encode_object($this->file, $status);
    }

    public function deleteById($id)
    {
        $array_decode = json_decode(file_get_contents($this->file), true);
        $status_array = $this->create_status_list_from_array($array_decode);

        //var_dump($id);
        //var_dump(count($status_array));
        $new_array = array();
        foreach ($status_array as $status) {
            //var_dump($status->getId());
            if ($status->getId() != $id) {
                $new_array[] = $status;
            }
        }

        //var_dump(count($new_array));
        $array_to_write = array();
        foreach ($new_array as $status) {
            $array_to_write[] = $this->create_array_from_object($status);
        }

        file_put_contents($this->file, json_encode($array_to_write, JSON_FORCE_OBJECT) . "\n");
    }
}
