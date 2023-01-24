<?php
namespace App\Http\Controllers\Api\Version1;

use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use \Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Swagger(
 *   schemes={"http"},
 *   host=API_HOST,
 *   basePath="/api",
 *   @SWG\Info(
 *     title="Homeey API UI",
 *     version="0.1"
 *   ),
 *   @SWG\SecurityScheme(
 *   securityDefinition="api_key",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization"
 *  )
 * )
 */

class ApiController extends Controller {

	protected $auth;
    public $locale;
    public $user;


    public function __construct()
    {
    	$this->getUser();
//        $this->middleware('api.log');
    }
	/**
     * @var int
     */
    protected $statusCode = Res::HTTP_OK;
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * @param $message
     * @return json response
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondCreated($message, $data=null){
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_CREATED,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondWithSuccess($data=null,$message = 'Action Successfully'){
        if(isset($data['data'])){
            $data = $data['data'];
        }
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data, $message){
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $paginate->total(),
                'total_pages' => ceil($paginate->total() / $paginate->perPage()),
                'current_page' => $paginate->currentPage(),
                'limit' => $paginate->perPage(),
            ]
        ]);
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondNotFound($message = 'Not Found!'){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_NOT_FOUND,
            'message' => $message,
        ]);
    }

    public function respondInternalError($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
        ]);
    }
    public function respondValidationError($message, $errors){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $errors
        ]);
    }
    public function respond($data, $headers = []){
        if(isset($data['data']['data'])){
            $data['paginator'] = $data['data']['paginator'];
            $data['data'] = $data['data']['data'];
        }
        return Response::json($data, 200, $headers);
    }
    public function respondWithError($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_UNAUTHORIZED,
            'message' => $message,
        ]);
    }

    public function getUser(){
         $this->user = $this->findUserWithBearerToken(request()->header('Authorization'));
         return $this;
    }
}