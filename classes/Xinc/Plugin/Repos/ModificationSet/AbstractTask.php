<?php
/**
 * This interface represents a publishing mechanism to publish build results
 * 
 * @package Xinc.Plugin
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

require_once 'Xinc/Plugin/Task/Base.php';

abstract class Xinc_Plugin_Repos_ModificationSet_AbstractTask extends Xinc_Plugin_Task_Base
{
    const STOPPED = -1;
    const FAILED = -2;
    
    /**
     * abstract process of a modification set
     *
     * @param Xinc_Build_Interface $build
     */
    public final function process(Xinc_Build_Interface &$build)
    {
        
        if ( ($status = $this->checkModified($build)) === true ) {
            
            $build->setStatus(Xinc_Build_Interface::PASSED);
        } else if ( $status === Xinc_Plugin_Repos_ModificationSet_AbstractTask::STOPPED ) {
            $build->setStatus(Xinc_Build_Interface::STOPPED);
        } else if ( $status === Xinc_Plugin_Repos_ModificationSet_AbstractTask::FAILED ) {
            $build->setStatus(Xinc_Build_Interface::FAILED);
        } else if ( $status === false ) {
            $build->setStatus(Xinc_Build_Interface::STOPPED);
        }
        
    }
    
        /**
     * Check if this modification set has been modified
     *
     */
    public abstract function checkModified(Xinc_Build_Interface &$build);
    
    /**
     * Check necessary variables are set
     * 
     * @throws Xinc_Exception_MalformedConfig
     */
    public function validate()
    {
        try {
            return $this->validateTask();
        }
        catch(Exception $e){
            Xinc_Logger::getInstance()->error('Could not validate: '
                                             . $e->getMessage());
            return false;
        }
    }
    
    public abstract function validateTask();
    
}