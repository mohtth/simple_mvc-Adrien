<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index()
    {
        $contactManager = new ContactManager();
        $data = $contactManager->selectAll();

        return $this->twig->render('Contact/index.html.twig', ['produits' => $data]);
    }

    public function modifier(string $id)
    {
        $contactManager = new ContactManager();
        $data = $contactManager->selectOneById($id);

        return $this->twig->render('Contact/modifier.html.twig', ['produit' => $data]);
    }

    public function update(int $id): string
    {
        $contactManager = new ContactManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $contactManager->update($id, $titre);
        }

        $data = $contactManager->selectAll();
        return $this->twig->render('Contact/index.html.twig', ['produits' => $data]);
    }


    public function ajouter()
    {
        return $this->twig->render('Contact/ajouter.html.twig');
    }

    public function inserer()
    {
        $controler = new ContactManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $controler->insert($titre);
        }

        $data = $controler->selectAll();
        return $this->twig->render('Contact/index.html.twig', ['produits' => $data]);
    }
    public function delete(int $id)
    {
        $Val = new ContactManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Val->delete($id);

        }
        $data = $Val->selectAll();
        return $this->twig->render('Contact/index.html.twig', ['produits' => $data]);
    }

}