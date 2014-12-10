package caminosMinimos;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Comparator;
import java.util.List;
import java.util.PriorityQueue;

public class Dijkstra {
	public Integer[][] caminoMinimo(Integer[][] weight,int source){
	    //auxiliary constants
	    final int SIZE = weight.length;
	    final int EVE = -1;//to indicate no predecessor
	    final int INFINITY = Integer.MAX_VALUE;
	 
	    //declare and initialize pred to EVE and minDist to INFINITY
	    Integer[] pred = new Integer[SIZE];
	    Integer[] minDist = new Integer[SIZE];
	    Arrays.fill(pred, EVE);
	    Arrays.fill(minDist, INFINITY);
	 
	    //set minDist[source] =0 because source is 0 distance from itself.
	    minDist[source] = 0;
	 
	    PriorityQueue<Integer[]> pq = createPriorityQueue(minDist);
	 
	    while (!pq.isEmpty()) {
	      updatePriorityQueue(pq);
	      int v = pq.remove()[0];
	      for (Integer[] XD : adjacency(weight, pq, v)) {
	        Integer x = XD[0];
	        //triangle inequality
	        if (null != x && minDist[x] > minDist[v] + weight[v][x]) {
	          minDist[x] = minDist[v] + weight[v][x];
	          pred[XD[0]] = v;
	          XD[1] = minDist[x];//update pq.
	        }
	      }
	    }
	    Integer[][] result = {pred, minDist};
	    return result;
	  }
	 
	  /*********************************************************************
	   * Create a priority queue and load it with the vertices sorted by minDist.
	   ********************************************************************/
	  private PriorityQueue<Integer[]> createPriorityQueue(Integer[] dist) {
	    PriorityQueue<Integer[]> pq = new PriorityQueue<Integer[]>(11,
	            new Comparator<Integer[]>() {
	              public int compare(Integer[] A, Integer[] B) {
	                return A[1] < B[1] ? -1 : 1;
	              }
	            });
	    for (int v = 0; v < dist.length; v++) {
	      pq.add(new Integer[]{v, dist[v]});
	    }
	    return pq;
	  }
	 
	  /******************************************************************
	   *  Retrieve all the neighbors of vertex v that are in the priority queue pq.
	   *****************************************************************/
	  private List<Integer[]> adjacency(Integer[][] G,
	          PriorityQueue<Integer[]> pq, int v) {
	    List<Integer[]> result = new ArrayList<Integer[]>();
	    for (Integer[] ent : pq) {// {u,key[u]}
	      int u = ent[0];
	      if (G[v][u] != null) {
	        result.add(ent);
	      }
	    }
	    return result;
	  }
	 
	  /*****************************************************************
	   * Re-prioritize the queue based on changes in the
	   *    minDist array.
	   *
	   * Technical Details: Dijktra's algorithm requires a priority queue
	   *    that changes continuously to reflect changes in minDist.
	   *    For Java it does not suffice to simply pass new values to
	   *    the array objects that constitute the queue. The
	   *    PriorityQueue data structure in Java only checks its structure
	   *    when it is adding or removing elements. It is unaware of any
	   *    direct changes to the objects it comprises. Therefore to force
	   *    the queue to re-prioritize, an element is removed and then
	   *    immediately added back.
	   *
	   *****************************************************************/
	  private void updatePriorityQueue(PriorityQueue<Integer[]> pq) {
	    pq.add(pq.remove());
	  }
}
