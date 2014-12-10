package caminosMinimos;

import org.junit.Test;
import static org.junit.Assert.*;

public class DijkstraTest {
	
	  @Test
	  public void testCaminoMinimo() {
	    Integer[][] pesos = {
	      {null, 10, null, null, 3},
	      {null, null, 2, null, 1},
	      {null, null, null, 7, null},
	      {null, null, 9, null, null},
	      {null, 4, 8, 2, null}
	    };
	 
	    int inicial = 0;
	    Dijkstra dijkstra = new Dijkstra();
	 
	    Integer[][] esperado = {{-1, 4, 1, 4, 0}, {0, 7, 9, 5, 3}};
	    Integer[][] real = dijkstra.caminoMinimo(pesos, inicial);
	   
	    assertArrayEquals(esperado, real);		// ¿Coinciden el resultado esperado con el resultado real?
	    assertNotNull(real);					// ¿El resultado real es distinto de nulo?
	    assertTrue(esperado.length > 0);		// ¿El resultado esperado dispone de una lista de nodos?
	    assertTrue(real.length > 0);			// ¿El resultado real dispone de una lista de nodos?
	  }
}
