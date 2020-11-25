<?php
 namespace App\Controller;
 use App\Repository\CustomerRepository;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Response;
/**
 * Description of CustomerController
 *
 * @author Sławomir
 */
class CustomerController {
  
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route("/customers/", name="add_customer", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $firstName = $data['name'];
        $lastName = $data['surname'];
        $email = $data['email'];
        $phoneNumber = $data['phone'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->customerRepository->saveCustomer($firstName, $lastName, $email, $phone);

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
    }
    /**
 * @Route("/customers/{id}", name="get_one_customer", methods={"GET"})
 */
public function get($id): JsonResponse
{
    $customer = $this->customerRepository->findOneBy(['id' => $id]);

    $data = [
        'id' => $customer->getId(),
        'firstName' => $customer->getName(),
        'lastName' => $customer->getSurname(),
        'email' => $customer->getEmail(),
        'phoneNumber' => $customer->getPhone(),
    ];

    return new JsonResponse($data, Response::HTTP_OK);
}
/**
 * @Route("/customers", name="get_all_customers", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $customers = $this->customerRepository->findAll();
    $data = [];

    foreach ($customers as $customer) {
        $data[] = [
            'id' => $customer->getId(),
            'name' => $customer->getName(),
            'surname' => $customer->getSurname(),
            'email' => $customer->getEmail(),
            'phone' => $customer->getPhone(),
        ];
    

    return new JsonResponse($data, Response::HTTP_OK);
    } 
}
  /**
 * @Route("/customers/{id}", name="update_customer", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $customer = $this->customerRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

    empty($data['name']) ? true : $customer->setFirstName($data['name']);
    empty($data['surname']) ? true : $customer->setLastName($data['surname']);
    empty($data['email']) ? true : $customer->setEmail($data['email']);
    empty($data['phone']) ? true : $customer->setPhoneNumber($data['phone']);

    $updatedCostumer = $this->customerRepository->updateCustomer($customer);

    return new JsonResponse($updatedCostumer->toArray(), Response::HTTP_OK);
}
/**
 * @Route("/customers/{id}", name="delete_customer", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $customer = $this->customerRepository->findOneBy(['id' => $id]);

    $this->customerRepository->removeCustomer($customer);

    return new JsonResponse(['status' => 'Customer deleted'], Response::HTTP_NO_CONTENT);
}
}
