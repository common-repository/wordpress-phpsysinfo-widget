<?php
/***************************************************************************
*   Copyright (C) 2008 by phpSysInfo - A PHP System Information Script    *
*   http://phpsysinfo.sourceforge.net/                                    *
*                                                                         *
*   This program is free software; you can redistribute it and/or modify  *
*   it under the terms of the GNU General Public License as published by  *
*   the Free Software Foundation; either version 2 of the License, or     *
*   (at your option) any later version.                                   *
*                                                                         *
*   This program is distributed in the hope that it will be useful,       *
*   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
*   GNU General Public License for more details.                          *
*                                                                         *
*   You should have received a copy of the GNU General Public License     *
*   along with this program; if not, write to the                         *
*   Free Software Foundation, Inc.,                                       *
*   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
***************************************************************************/
//
// $Id: class.WINNT.inc.php,v 1.38 2008/05/27 13:40:02 bigmichi1 Exp $
//
class sysinfo {
  // $wmi holds the COM object that we pull all the WMI data from
  private $wmi;
  // Error singleton
  private $error;
  // $wmidevices holds all devices, which are in the system
  private $wmidevices;
  // setting for debugging
  private $debug = debug;
  // this constructor initialis the $wmi object
  public function __construct() {
    $this->error = Error::singleton();
    // don't set this params for local connection, it will not work
    $strHostname = '';
    $strUser = '';
    $strPassword = '';
    // initialize the wmi object
    $objLocator = new COM("WbemScripting.SWbemLocator");
    if ($strHostname == "") {
      $this->wmi = $objLocator->ConnectServer();
    } else {
      $this->wmi = $objLocator->ConnectServer($strHostname, "rootcimv2", "$strHostname\$strUser", $strPassword);
    }
  }
  // private function for getting a list of values in the specified context, optionally filter this list, based on the list from second parameter
  private function GetWMI($strClass, $strValue = array()) {
    $arrData = array();
    try {
      $objWEBM = $this->wmi->Get($strClass);
      $arrProp = $objWEBM->Properties_;
      $arrWEBMCol = $objWEBM->Instances_();
      foreach($arrWEBMCol as $objItem) {
        @reset($arrProp);
        $arrInstance = array();
        foreach($arrProp as $propItem) {
          eval("\$value = \$objItem->" . $propItem->Name . ";");
          if (empty($strValue)) {
            $arrInstance[$propItem->Name] = trim($value);
          } else {
            if (in_array($propItem->Name, $strValue)) {
              $arrInstance[$propItem->Name] = trim($value);
            }
          }
        }
        $arrData[] = $arrInstance;
      }
    }
    catch(Exception $e) {
      if ($this->debug) {
        $this->error->addError($e->getCode(), $e->getMessage());
      }
    }
    return $arrData;
  }
  // private function for getting different device types from the system
  private function _devicelist($strType) {
    if (empty($this->wmidevices)) {
      $this->wmidevices = $this->GetWMI("Win32_PnPEntity", array("Name", "PNPDeviceID"));
    }
    $list = array();
    foreach($this->wmidevices as $device) {
      if (substr($device["PNPDeviceID"], 0, strpos($device["PNPDeviceID"], "\\") +1) == ($strType . "\\")) {
        $list[] = $device["Name"];
      }
    }
    return $list;
  }
  // get our apache SERVER_NAME or vhost
  public function vhostname() {
    if (!($result = getenv('SERVER_NAME'))) {
      $result = 'N.A.';
    }
    return $result;
  }
  // get the IP address of our vhost name
  public function vip_addr() {
    return gethostbyname($this->vhostname());
  }
  // get our canonical hostname
  public function chostname() {
    $buffer = $this->GetWMI("Win32_ComputerSystem", array("Name"));
    $result = $buffer[0]["Name"];
    $ip = gethostbyname($result);
    if ($ip != $result) {
      return gethostbyaddr($ip);
    } else {
      return 'Unknown';
    }
  }
  // get the IP address of our canonical hostname
  public function ip_addr() {
    $buffer = $this->GetWMI("Win32_ComputerSystem", array("Name"));
    $result = $buffer[0]["Name"];
    return gethostbyname($result);
  }
  public function kernel() {
    $buffer = $this->GetWMI("Win32_OperatingSystem", array("Version", "ServicePackMajorVersion"));
    $result = $buffer[0]["Version"];
    if ($buffer[0]["ServicePackMajorVersion"] > 0) {
      $result.= " SP" . $buffer[0]["ServicePackMajorVersion"];
    }
    return $result;
  }
  // get the time the system is running
  public function uptime() {
    $result = 0;
    date_default_timezone_set("UTC");
    $buffer = $this->GetWMI("Win32_OperatingSystem", array("LastBootUpTime", "LocalDateTime"));
    $byear = intval(substr($buffer[0]["LastBootUpTime"], 0, 4));
    $bmonth = intval(substr($buffer[0]["LastBootUpTime"], 4, 2));
    $bday = intval(substr($buffer[0]["LastBootUpTime"], 6, 2));
    $bhour = intval(substr($buffer[0]["LastBootUpTime"], 8, 2));
    $bminute = intval(substr($buffer[0]["LastBootUpTime"], 10, 2));
    $bseconds = intval(substr($buffer[0]["LastBootUpTime"], 12, 2));
    $lyear = intval(substr($buffer[0]["LocalDateTime"], 0, 4));
    $lmonth = intval(substr($buffer[0]["LocalDateTime"], 4, 2));
    $lday = intval(substr($buffer[0]["LocalDateTime"], 6, 2));
    $lhour = intval(substr($buffer[0]["LocalDateTime"], 8, 2));
    $lminute = intval(substr($buffer[0]["LocalDateTime"], 10, 2));
    $lseconds = intval(substr($buffer[0]["LocalDateTime"], 12, 2));
    $boottime = mktime($bhour, $bminute, $bseconds, $bmonth, $bday, $byear);
    $localtime = mktime($lhour, $lminute, $lseconds, $lmonth, $lday, $lyear);
    $result = $localtime-$boottime;
    return $result;
  }
  // count the users, which are logged in
  public function users() {
    $users = 0;
    $buffer = $this->GetWMI("Win32_Process", array("Caption"));
    foreach($buffer as $process) {
      if (strtoupper($process["Caption"]) == strtoupper("explorer.exe")) {
        $users++;
      }
    }
    return $users;
  }
  // get the load of the processors
  public function loadavg($bar = false) {
    $buffer = $this->GetWMI("Win32_Processor", array("LoadPercentage"));
    $cpuload = array();
    for ($i = 0;$i < count($buffer);$i++) {
      $cpuload['avg'][] = $buffer[$i]["LoadPercentage"];
    }
    if ($bar) {
      $cpuload['cpupercent'] = array_sum($cpuload['avg']) /count($buffer);
    }
    return $cpuload;
  }
  // get some informations about the cpu's
  public function cpu_info() {
    $buffer = $this->GetWMI("Win32_Processor", array("Name", "L2CacheSize", "CurrentClockSpeed", "ExtClock", "NumberOfCores"));
    $results["cpus"] = 0;
    foreach($buffer as $cpu) {
      if (isset($cpu["NumberOfCores"])) {
        $results["cpus"]+= $cpu["NumberOfCores"];
      } else {
        $results["cpus"]++;
      }
      $results["model"] = $cpu["Name"];
      $results["cache"] = $cpu["L2CacheSize"];
      $results["cpuspeed"] = $cpu["CurrentClockSpeed"];
      $results["busspeed"] = $cpu["ExtClock"];
    }
    return $results;
  }
  // get the pci devices from the system
  public function pci() {
    $pci = $this->_devicelist("PCI");
    return $pci;
  }
  // get the ide devices from the system
  public function ide() {
    $buffer = $this->_devicelist("IDE");
    $ide = array();
    foreach($buffer as $device) {
      $ide[]['model'] = $device;
    }
    return $ide;
  }
  // get the scsi devices from the system
  public function scsi() {
    $scsi = $this->_devicelist("SCSI");
    return $scsi;
  }
  // get the usb devices from the system
  public function usb() {
    $usb = $this->_devicelist("USB");
    return $usb;
  }
  // get the netowrk devices and rx/tx bytes
  public function network() {
    $results = array();
    $buffer = $this->GetWMI("Win32_PerfRawData_Tcpip_NetworkInterface");
    foreach($buffer as $device) {
      $dev_name = $device["Name"];
      // http://msdn.microsoft.com/library/default.asp?url=/library/en-us/wmisdk/wmi/win32_perfrawdata_tcpip_networkinterface.asp
      // there is a possible bug in the wmi interfaceabout uint32 and uint64: http://www.ureader.com/message/1244948.aspx, so that
      // magative numbers would occour, try to calculate the nagative value from total - positive number
      if ($device["BytesSentPersec"] < 0) {
        $results[$dev_name]['tx_bytes'] = $device["BytesTotalPersec"]-$device["BytesReceivedPersec"];
      } else {
        $results[$dev_name]['tx_bytes'] = $device["BytesSentPersec"];
      }
      if ($device["BytesReceivedPersec"] < 0) {
        $results[$dev_name]['rx_bytes'] = $device["BytesTotalPersec"]-$device["BytesSentPersec"];
      } else {
        $results[$dev_name]['rx_bytes'] = $device["BytesReceivedPersec"];
      }
      $results[$dev_name]['errs'] = $device["PacketsReceivedErrors"];
      $results[$dev_name]['drop'] = $device["PacketsReceivedDiscarded"];
    }
    return $results;
  }
  public function memory() {
    /**
     * Fetch the physical memory information.
     * Win32_OperatingSystem: http://msdn2.microsoft.com/En-US/library/aa394239.aspx
     */
    $buffer = $this->GetWMI("Win32_OperatingSystem", array('TotalVisibleMemorySize', 'FreePhysicalMemory'));
    $results['ram']['total'] = $buffer[0]['TotalVisibleMemorySize'];
    $results['ram']['free'] = $buffer[0]['FreePhysicalMemory'];
    // Calculate used physical memory.
    $results['ram']['used'] = $results['ram']['total']-$results['ram']['free'];
    // Calculate percent used.
    $results['ram']['percent'] = ceil(($results['ram']['used']*100) /$results['ram']['total']);
    // Set the swap info to zero. Just in case, I guess.
    $results['swap']['total'] = 0;
    $results['swap']['used'] = 0;
    $results['swap']['free'] = 0;
    $results['swap']['percent'] = 0;
    /**
     * Fetch information about the windows page file.
     * Win32_PageFileUsage: http://msdn2.microsoft.com/en-us/library/aa394246.aspx
     */
    $buffer = $this->GetWMI("Win32_PageFileUsage"); // no need to filter, using nearly everything from output
    $k = 0;
    $results['devswap'] = array();
    foreach($buffer as $swapdevice) {
      $results['devswap'][$k]['dev'] = $swapdevice['Name'];
      $results['devswap'][$k]['total'] = $swapdevice['AllocatedBaseSize']*1024;
      $results['devswap'][$k]['used'] = $swapdevice['CurrentUsage']*1024;
      // Calculate free swap.
      $results['devswap'][$k]['free'] = ($swapdevice['AllocatedBaseSize']-$swapdevice['CurrentUsage']) *1024;
      // Calculate percent used.
      $results['devswap'][$k]['percent'] = ceil($swapdevice['CurrentUsage']/$swapdevice['AllocatedBaseSize']);
      // Calculate the swap totals.
      $results['swap']['total']+= $results['devswap'][$k]['total'];
      $results['swap']['used']+= $results['devswap'][$k]['used'];
      $results['swap']['free']+= $results['devswap'][$k]['free'];
      // Iterate the counter by one.
      $k+= 1;
    }
    // Calculate the percent used of the total swap space.
    if ($k > 0) {
      $results['swap']['percent'] = ceil($results['swap']['used']/(($results['swap']['total'] <= 0) ? 1 : $results['swap']['total']) *100);
    }
    return $results;
  }
  // get the filesystem informations
  public function filesystems() {
    $typearray = array("Unknown", "No Root Directory", "Removable Disk", "Local Disk", "Network Drive", "Compact Disc", "RAM Disk");
    $floppyarray = array("Unknown", "5 1/4 in.", "3 1/2 in.", "3 1/2 in.", "3 1/2 in.", "3 1/2 in.", "5 1/4 in.", "5 1/4 in.", "5 1/4 in.", "5 1/4 in.", "5 1/4 in.", "Other", "HD", "3 1/2 in.", "3 1/2 in.", "5 1/4 in.", "5 1/4 in.", "3 1/2 in.", "3 1/2 in.", "5 1/4 in.", "3 1/2 in.", "3 1/2 in.", "8 in.");
    $buffer = $this->GetWMI("Win32_LogicalDisk", array("Name", "Size", "FreeSpace", "FileSystem", "DriveType", "MediaType"));
    $k = 0;
    foreach($buffer as $filesystem) {
      if (hide_mount($filesystem["Name"])) {
        continue;
      }
      $results[$k]['mount'] = $filesystem["Name"];
      $results[$k]['size'] = $filesystem["Size"]/1024;
      $results[$k]['used'] = ($filesystem["Size"]-$filesystem["FreeSpace"]) /1024;
      $results[$k]['free'] = $filesystem["FreeSpace"]/1024;
      @$results[$k]['percent'] = ceil($results[$k]['used']/$results[$k]['size']*100); // silence this line, nobody is having a floppy in the drive everytime
      $results[$k]['fstype'] = $filesystem["FileSystem"];
      $results[$k]['disk'] = $typearray[$filesystem["DriveType"]];
      if ($filesystem["MediaType"] != "" && $filesystem["DriveType"] == 2) $results[$k]['disk'].= " (" . $floppyarray[$filesystem["MediaType"]] . ")";
      $k+= 1;
    }
    return $results;
  }
  public function distro() {
    $buffer = $this->GetWMI("Win32_OperatingSystem", array("Caption"));
    return $buffer[0]["Caption"];
  }
  public function distroicon() {
    return 'xp.gif';
  }
}
?>
