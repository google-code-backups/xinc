<?php
/**
 * Main configuration class, handles the system.xml
 * 
 * @package Xinc.Project
 * @author Arno Schneider
 * @version 2.0
 * @copyright 2007 Arno Schneider, Barcelona
 * @license  http://www.gnu.org/copyleft/lgpl.html GNU/LGPL, see license.php
 *    This file is part of Xinc.
 *    Xinc is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU Lesser General Public License as published
 *    by the Free Software Foundation; either version 2.1 of the License, or    
 *    (at your option) any later version.
 *
 *    Xinc is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Lesser General Public License for more details.
 *
 *    You should have received a copy of the GNU Lesser General Public License
 *    along with Xinc, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once 'Xinc/Project/Config/File.php';
require_once 'Xinc/Project/Config/Parser.php';

class Xinc_Project_Config
{
	/**
	 * Iterator holding all the project configuration in xml
	 *
	 * @var Xinc_Project_Config_Iterator
	 */
	private $_projectConfigs;
	
	/**
	 * Iterator holding all the configured projects
	 *
	 * @var Xinc_Project_Iterator
	 */
	private $_projects;
    /**
     * Reads the system.xml
     * - parses it
     * - loads projects
     *
     * @param string $fileName path to system.xml
     * @throws Xinc_Project_Config_Exception_FileNotFound
     * @throws Xinc_Project_Config_Exception_InvalidEntry
     */
    public function __construct($fileName)
    {
        $configFile = new Xinc_Project_Config_File($fileName);
        $configParser = new Xinc_Project_Config_Parser($configFile);
        
        $this->_projectConfigs = $configParser->getProjects();
        $this->_generateProjects();
    }
    
    private function _generateProjects()
    {
    	$projects = array();
    	
    	while ($this->_projectConfigs->hasNext()) {
    		$projectConfig = $this->_projectConfigs->next();
    		$projectObject = new Xinc_Project();
    		
    		foreach ($projectConfig['@attributes'] as $name => $value ) {
    			$method = 'set' . ucfirst(strtolower($name));
    			$projectObject->$method($value);
    		}
    		
    		$projects[] = $projectObject;
    	}
    	
    	$this->_projects = new Xinc_Project_Iterator($projects);
    }
    
    
    /**
     * returns the configured Projects
     *
     * @return Xinc_Project_Iterator
     */
    public function getProjects()
    {
    	return $this->_projects;
    }
    
   
}