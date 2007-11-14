<?php
/**
 * Frontend-Gui Events
 * 
 * @package Xinc.Gui
 * @author Arno Schneider
 * @version 2.0
 * @copyright 2007 David Ellis, One Degree Square
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
class Xinc_Gui_Event
{
    /**
     * Event is triggered when a Page is loaded by a Http-Request
     *
     */
    const PAGE_LOAD=1;
    /**
     * Event is triggered when a new user arrives without a session
     *
     */
    const SESSION_START=0;
    /**
     * Event is triggered when a session is destroyed
     *
     */
    const SESSION_END=-1;
}