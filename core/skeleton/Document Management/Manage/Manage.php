<?php
class ManageDocument
{
    public $Document_Name;
    public $Document_Type;
    public $Document_Path;
    public $Document_Extension;
    public $tmppath = 'tmp/document';
    public function __construct($name, $type, $path, $extension)
    {
        $this->Document_Name = $name;
        $this->Document_Type = $type;
        $this->Document_Path = $path;
        $this->Document_Extension = $extension;
    }

    public function edit($c, $e)
    {
        if ($this->Document_Type == 'Docx' || $this->Document_Type == 'Microsoft Word' || $this->Document_Type == 'Word')
        {
        rename($this->Document_Path.'/'.$this->Document_Name.'.'.$this->Document_Extension, $this->Document_Path.'/'.$this->Document_Name.'.zip');
        $path = $this->Document_Path.'/'.$this->Document_Name.'.zip';
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if($res === true)
        {
            $xml = $zip->getFromName('word/document.xml');
        }
        for ($i=0; $i<count($c); $i++)
        {
            $xml = str_replace($c[$i], $e[$i], $xml);
        }
        $zip->addFromString('word/document.xml', $xml);
        $zip->close();
        }
        rename($this->Document_Path.'\\'.$this->Document_Name.'.zip', $this->Document_Path.'\\'.$this->Document_Name.'.'.$this->Document_Extension);
    }
}
?>
