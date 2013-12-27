<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Movies Controller
 *
 * @property Movie $Movie
 */
class MoviesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$conditions = array();
		//Transform POST into GET
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
			$filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
			// We need to overwrite the page every time we change the parameters
			$filter_url['page'] = 1;

			// for each filter we will add a GET parameter for the generated url
			foreach($this->data['Filter'] as $name => $value){
				if($value){
					// You might want to sanitize the $value here
					// or even do a urlencode to be sure
					$filter_url[$name] = urlencode($value);
				}
			}	
			// now that we have generated an url with GET parameters, 
			// we'll redirect to that page
			return $this->redirect($filter_url);
		} else {
			// Inspect all the named parameters to apply the filters
			foreach($this->params['named'] as $param_name => $value){
				// Don't apply the default named parameters used for pagination
				if(!in_array($param_name, array('page','sort','direction','limit'))){
					// You may use a switch here to make special filters
					// like "between dates", "greater than", etc
					if($param_name == "search"){
						$conditions['OR'] = array(
							array('Movie.title LIKE' => '%' . $value . '%'),
    						array('Movie.description LIKE' => '%' . $value . '%')
						);
					} else {
						$conditions['Movie.'.$param_name] = $value;
					}					
					$this->request->data['Filter'][$param_name] = $value;
				}
			}
		}
		$this->Movie->recursive = 0;
		$this->paginate = array(
			'limit' => 8,
			'conditions' => $conditions
		);
		$this->set('movies', $this->paginate());

		// get the possible values for the filters and 
		// pass them to the view
		$genres = $this->Movie->Genre->find('list');
		$directors = $this->Movie->Director->find('list');
		$this->set(compact('genres', 'directors'));

		// Pass the search parameter to highlight the text
		$this->set('search', isset($this->params['named']['search']) ? $this->params['named']['search'] : "");
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Movie->exists($id)) {
			throw new NotFoundException(__('Invalid movie'));
		}
		$options = array('conditions' => array('Movie.' . $this->Movie->primaryKey => $id));
		$this->set('movie', $this->Movie->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Movie->create();
			if ($this->Movie->save($this->request->data)) {
				$this->Session->setFlash(__('The movie has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The movie could not be saved. Please, try again.'));
			}
		}
		$genres = $this->Movie->Genre->find('list');
		$directors = $this->Movie->Director->find('list');
		$this->set(compact('genres', 'directors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Movie->exists($id)) {
			throw new NotFoundException(__('Invalid movie'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Movie->save($this->request->data)) {
				$this->Session->setFlash(__('The movie has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The movie could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Movie.' . $this->Movie->primaryKey => $id));
			$this->request->data = $this->Movie->find('first', $options);
		}
		$genres = $this->Movie->Genre->find('list');
		$directors = $this->Movie->Director->find('list');
		$this->set(compact('genres', 'directors'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Movie->id = $id;
		if (!$this->Movie->exists()) {
			throw new NotFoundException(__('Invalid movie'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Movie->delete()) {
			$this->Session->setFlash(__('Movie deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Movie was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
