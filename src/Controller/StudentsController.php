<?php

namespace App\Controller;
//ci-dessous tous les liens ('use') de ce qu'on va utiliser d'un autre emplacement
use App\Entity\Students;
use App\Form\StudentType;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentsController extends AbstractController
{
    #[Route('/students', name: 'students', methods: ['GET'])]
// route = adresse et nom de la destination de la fonction.
    function students (StudentsRepository $studentsRepository)
        //n'importe quel nom pour la fonction et on passe les paramètres en variables
    {
        //récupérer tous les students
        //les envoyer à la vue
        $students = $studentsRepository->findBy(['active' => true], ['lastname' => 'ASC']);
        //variable sur laquelle on applique la méthode avec ses critères
        $studentsOff = $studentsRepository->findBy(['active' => false], ['lastname' => 'ASC']);

        //rediriger vers notre html.twig : doit avoir le même nom que le name de la route
        return $this->render('students.html.twig', [
            //déclare dans un array cequ'on veut afficher ( le terme en vert peut être n'importe
            'students' => $students,
            'studentsOff' => $studentsOff
        ]);
    }

    #[Route('/student/{id}', name: 'student', methods: ['GET'])]
//on veut récupérer un student avec l'id
    public function student (StudentsRepository $studentsRepository, $id)
        //studentRepository = emplacement des requêtes
    {
      $student = $studentsRepository->findOneBy(["id" => $id]);
      // on declare l'id dans une variable $id
      return $this->render('student.html.twig', ['student' => $student]);
      // on envoie notre variable $student dans un objet n'importe quel nom
    }

    #[Route('/studentdelete/{id}', name: 'deleteStudent', methods: ['GET'])]

    public function deleteStudent (
        StudentsRepository $studentsRepository,
        $id,
        EntityManagerInterface $entityManager
    )
    {
        // va chercher l'élève à supprimer
        $student = $studentsRepository->findOneBy(["id" => $id]);
        $entityManager->remove($student);
        $entityManager->flush();
        // flush = remove dans la base de données

        return $this->redirectToRoute('students');
    }

    #[Route('/studentstatus/{id}', name: 'changeStatus', methods: ['GET'])]

    public function changeStatus (
        StudentsRepository $studentsRepository,
                           $id,
        EntityManagerInterface $entityManager
    )
    {
        // va chercher l'élève à modifier
        $student = $studentsRepository->findOneBy(["id" => $id]);
        if ($student->getActive(true)) {
            $student->setActive(false);
        } else {
            $student->setActive(true);
        }
        $entityManager->persist($student);
        //appliquer la modif
        $entityManager->flush();

        return $this->redirectToRoute('students');
        // là où on veut l'afficher
    }

   #[Route('/addstudent', name: 'addStudent', methods: ['GET', 'POST'])]

    public function addStudent (Request $request, StudentsRepository $studentsRepository)
    {
        $student = new Students();
        $form = $this->createForm(StudentType::class, $student);
        //methode création de formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $studentsRepository->add($student);

            return $this->redirectToRoute('students');
        }

        return $this->render('addStudent.html.twig', ['studentForm' => $form->createView()]);
    }

    #[Route('/updatestudent/{id}', name: 'updateStudent', methods: ['GET', 'POST'])]
    public function updateStudent($id, StudentsRepository $studentsRepository, Request $request)
    {

       $student = $studentsRepository->findOneBy(["id" => $id]);

       $form = $this->createForm(StudentType::class, $student);
       $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $studentsRepository->add($student);

            return $this->redirectToRoute('students');
        }

       return $this->render('updatestudent.html.twig', [
           'studentForm' =>$form->createView(),
           'student' =>$student
       ]);
    }

}