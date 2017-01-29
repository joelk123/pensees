<?php
namespace pensees;

defined('__PENSEES__') or die('Acces interdit');

class PenseesModel 
{
    public function creer(array $data) {
        $db = \F3il\Application::getDB();
        
        $sql = "INSERT INTO pensees SET pensee = :pensee, pseudo = :pseudo, date = :date";
        
        $req = $db->prepare($sql);
        $req->bindValue(':pensee',$data['pensee']);
        $req->bindValue(':pseudo',$data['pseudo']);
        $req->bindValue(':date',date('Y-m-d H:i:s'));
        
        try {
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error('Erreur SQL '.$ex->getMessage());
        }                                
    }
    
    public function aleatoire(){
        $db = \F3il\Application::getDB();
        
        $sql = "SELECT * FROM pensees ORDER BY RAND() LIMIT 0,1";
        
        $req = $db->prepare($sql);
        
        try {
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error('Erreur SQL '.$ex->getMessage());
        }
        return $req->fetch(\PDO::FETCH_ASSOC);
        
    }
    
    public function dernieres() {
        $db = \F3il\Application::getDB();
        
        $sql = "SELECT * FROM pensees ORDER BY date DESC LIMIT 5";
        
        $req = $db->prepare($sql);                
        try {
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error('Erreur SQL '.$ex->getMessage());
        }             
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}
