<?php

require_once "../MetricSpace.php";

/**
 * The haversine distance is an equation important in navigation, giving 
 * great-circle distances between two points on a sphere from their longitudes
 * and latitudes.
 */
final class HaversineDistance extends MetricSpace
{
    const KM_TO_MILE_RATIO = 0.621371;
    const EARTH_RADIUS_KM  = 6371;
    
    /**
     * Computes haversine distance between $from and $to.
     */
    public function compute($from, $to)
    {
        $R     = self::EARTH_RADIUS_KM;
        $dLat  = deg2rad($to[1] - $from[1]);
        $dLong = deg2rad($to[2] - $from[2]);
        
        $a = pow(sin($dLat/2),2)
             + cos(deg2rad($from[1])) 
             * cos(deg2rad($to[1])) 
             * pow(sin($dLong/2),2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c;
        
        return round($this->KMtoMiles($d));
    }
        
    /**
     * Converts Kilometers to Miles.
     */    
    private function KMtoMiles($x)
    {
        return $x*self::KM_TO_MILE_RATIO;
    }
}
