<?php

namespace LotusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
/**
 * MaterielFamilleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MaterielFamilleRepository extends NestedTreeRepository
{
   public function getFormChoices()
    {
        $qb = $this->createQueryBuilder('m');
        $qb->where('m.id!=1');
        $qb->orderBy('m.root, m.lft', 'ASC');
        $list = $qb->getQuery()->getResult();
        $group_choices = array();
        foreach($list as $MaterielFamille) {
            $paths = $this->getPath($MaterielFamille);
            $path  = implode(' › ' , $paths);
            
            if($this->childCount($MaterielFamille)>0 ) {
                $group_choices[$path] = array();
                $group_path = '▾ '.$path;
            } else { // a leaf                
                $group_choices[$group_path][' ›› '.$MaterielFamille->getTitle()] = $MaterielFamille;
            }

        }
        
        return $group_choices;
    }

    /*
    public function getFormChoices()
    {
        //$this->findBy(array('parent'=>NULL));
        $groupChoices = array();
        $root = $this->getRootNodes()[0];
        $groupChoices['choices'] = $this->generateChildrenChoices($root);
        
        foreach($groupChoices as $choice) {
            
        }
        
        echo '<pre>';
        var_dump($groupChoices);
        echo '</pre>';
        return $groupChoices;
    }
    
    public function generateChildrenChoices($parent)
    {
        if(isset($depth) && $depth > 1000) return false;
        $choices = array();
        foreach($parent->getChildren() as $achild) {
            $choices[str_repeat('-', $achild->getLevel()).' '.$achild->getTitle().'('.$achild->getId().')'] = $achild;
            $choices[str_repeat('-', $achild->getLevel()).' '.$achild->getTitle().'('.$achild->getId().')'] = $this->generateChildrenChoices($achild);
            $depth = $achild->getLevel() ;
        }
        return $choices;
    }
    */
}